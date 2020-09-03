<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $query->orderBy('created_at','DESC');

        $users = $query->paginate(15);


        $data = [
            'users' => $users,
        ];

        return view('admin.user.index' , $data);


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

        $data  = [
            'companies' => $companies
        ];

        return view('admin.user.create', $data);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
        if(\Auth::user()->level !=2){
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //

        $companies = Company::all();

        $data  = [
            'companies' => $companies,
            'user' => $user
        ];

        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
        if($request->has('password')){
            $newpwd = Hash::make($request->input('password'));
            $user->password = $newpwd;
        }

        if($request->has('level')){
            $user->level = $request->input('level');
            if(Auth::user()->level == 1){
                $user->level = 0;
            }
        }
        $user->updated_at = now();
        $user->update();
        return redirect()->route('admin_users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
