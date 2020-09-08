<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\CompanyPermission;
use App\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;


class CompanyPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $permission_texts = ['無限制', '只限root/超級管理', '只限root'];

    public function index(Request $request)
    {
        //
        $query = CompanyPermission::query();
        $search_type = 0;
        $search_info = '';
        $permission_filter = -1;
        $sortBy = 'module_id';
        $sortBy_text = ['模組名稱', '公司名稱'];

        if ($request->has('sortBy')) {
            $sortBy = $request->input('sortBy');
        }


        if ($request->has('permission_filter')) {
            $permission_filter = $request->input('permission_filter');
        }
        if ($permission_filter >= 0) {
            $query->where('permission', '=', $permission_filter);
        }



        if ($request->has('search_type')) {
            $search_type = $request->query('search_type');
        }
        if ($search_type > 0) {
            $search_info = $request->query('search_info');
            switch ($search_type) {
                case 1:
                    $module_ids = Module::where('name', 'like', "%{$search_info}%")->pluck('id')->toArray();
                    $query->whereIn('module_id', $module_ids);
                    break;

                case 2:
                    $company_ids = Company::where('name', 'like', "%{$search_info}%")->pluck('id')->toArray();
                    $query->whereIn('company_id', $company_ids);
                    break;

                default:
                    break;
            }
        }


        $query->orderBy($sortBy);
        $permissions = $query->paginate(15);

        $data = [
            'permissions' => $permissions,
            'permission_texts' => $this->permission_texts,
            'permission_filter' => $permission_filter,
            'search_type' => $search_type,
            'search_info' => $search_info,
            'sortBy' => $sortBy,
            'sortBy_text' => $sortBy_text,
        ];

        return view('admin.permission.index', $data);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit(CompanyPermission $permission , Request $request)
    {
        //

        $data = [
            'permission' => $permission,
            'source_html' => $request->input('source_html'),
        ];

        return view('admin.permission.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyPermission $permission)
    {
        //


        $permission->permission = $request->input('permission');
        $permission->update_date = now();
        $permission->update();

        return Redirect::to($request->input('source_html'));



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
