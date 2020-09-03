<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Imports\CompanyImport;
use App\Imports\UserImport;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = User::query();

        $search_type = 0;
        $search_info = '';
        $is_active = -1;
        $type_filter = -1;
        $level_filter = -1;

        if ($request->has('is_active')) {
            $is_active = $request->input('is_active');
        }
        if ($is_active >= 0) {
            $query->where('is_active', '=', $is_active);
        }

        if ($request->has('type_filter')) {
            $type_filter = $request->input('type_filter');
        }
        if ($type_filter >= 0) {
            $query->where('type', '=', $type_filter);
        }


        if ($request->has('level_filter')) {
            $level_filter = $request->input('level_filter');
        }
        if ($level_filter >= 0) {
            if ($type_filter != 0) {
                $query->where('level', '=', $level_filter);


            }
        }

        if ($request->has('search_type')) {
            $search_type = $request->query('search_type');
        }
        if ($search_type > 0) {
            $search_info = $request->query('search_info');
            switch ($search_type) {
                case 1:
                    $ids = Company::where('name', 'like', "%{$search_info}%")->pluck('id')->toArray();
                    $query->whereIn('company_id', $ids);
                    break;
                case 2:
                    $query->where('name', 'like', "%{$search_info}%");
                    break;
                default:
                    break;
            }
        }


        $query->orderBy('created_at', 'DESC');

        $users = $query->paginate(15);


        $data = [
            'users' => $users,
            'search_info' => $search_info,
            'search_type' => $search_type,
            'type_filter' => $type_filter,
            'level_filter' => $level_filter,
            'is_active' => $is_active,
        ];

        return view('admin.user.index', $data);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        $companies = Company::all();

        $data = [
            'companies' => $companies
        ];

        return view('admin.user.create', $data);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|string|same:password',
            'level' => 'sometimes',
            'company_id' => 'required|min:1',
        ]);
        $create_data = $request->all();
        $create_data['type'] = 1;
        if (\Auth::user()->level != 2) {
            $create_data['level'] = 0;
            $create_data['company_id'] = \Auth::user()->company_id;
        }
        unset($create_data['password_confirmation']);
        unset($create_data['_token']);

        $user = User::create($create_data);
        $user->password = Hash::make($user->password);
        $user->update();

        return redirect()->route('admin_users.index');
    }

    function containsOnlyNull($input)
    {
        return empty(array_filter($input, function ($a) {
            return $a !== null;
        }));
    }

    public function import(Request $request)
    {
        if ($request->file('file') == null) {
            $msg = '必須上傳檔案';
            \Illuminate\Support\Facades\Session::flash('msg', $msg);
            return redirect()->back();
        }

        $extension = $request->file->getClientOriginalExtension();
        if (!in_array($extension, ['csv', 'xls', 'xlsx'])) {
            $msg = '檔案必需為excel格式(副檔名為csv,xls,xlsx)';
            Session::flash('msg', $msg);
            return redirect()->back();
        }
        try {
            $import = new UserImport();
            Excel::import($import, request()->file('file'));
            $rows = $import->getRows()->toArray();
            array_shift($rows);

            $msgs = [];
            $msg = '';
            foreach ($rows as $row) {
                if ($this->containsOnlyNull($row)) {
                    continue;
                }
                $rename_row = [
                    'name' => $row[0],
                    'email' => $row[1],
                    'password' => $row[2],
                    'type' => $row[3],
                    'level' => $row[4],
                ];
//                check product isbn exists
                $user = User::where('email', '=', $rename_row['email'])->first();
                if (!is_null($user)) {
                    $msg = '用戶: ' . $rename_row['email'] . '已存在，無法重複';
                    array_push($msgs, $msg);
                    continue;
                }
                $user = User::create([
                    'name' => $rename_row['name'],
                    'email' => $rename_row['email'],
                    'password' => Hash::make($rename_row['password']),
                    'company_id' => Auth::user()->company->id,
                    'type' => $rename_row['type'],
                    'level' => $rename_row['level'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $msg = '用戶信箱: ' . $rename_row['email'] . ' 用戶名稱: ' . $rename_row['name'] . '建立成功';
                array_push($msgs, $msg);

            }
            Session::flash('msgs', $msgs);
            return redirect()->back();

        } catch (\Exception $exception) {
            $msg = $exception->getMessage();
            Session::flash('msg', $msg);
            return redirect()->back();
        }

    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //

        $companies = Company::all();

        $data = [
            'companies' => $companies,
            'user' => $user
        ];

        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|string|same:password',
            'company_id' => 'required|min:1',
        ]);

        $user->name = $request->input('name');
        $user->company_id = $request->input('company_id');
        if ($request->has('password')) {
            $newpwd = Hash::make($request->input('password'));
            $user->password = $newpwd;
        }

        if ($request->has('level')) {
            $user->level = $request->input('level');
            if (Auth::user()->level == 1) {
                $user->level = 0;
            }
        }

        $user->is_active = $request->input('is_active');
        $user->updated_at = now();
        $user->update();
        return redirect()->route('admin_users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
