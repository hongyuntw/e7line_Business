<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        return view('login.login');

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

    function XORCipher($data, $key) {
        $dataLen = strlen($data);
        $keyLen = strlen($key);
        $output = $data;

        for ($i = 0; $i < $dataLen; ++$i) {
            $output[$i] = $data[$i] ^ $key[$i % $keyLen];
        }

        return $output;
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $email =  $request->input('email');
        $pwd = $request->input('password');
        $server = 'server';

        $key = 'e7line';

        $encrypted_pwd = $this->XORCipher($pwd,$key);
        $encrypted_pwd = base64_encode($encrypted_pwd);
        $api_path = 'https://www.e7line.com/API/outsideLogin.aspx';


        $client = new \GuzzleHttp\Client();
        $result = $client->request('POST', $api_path, [
            'form_params' => [
                'Action' => $server,
                'Email' => $email ,
                'Password' => $encrypted_pwd,
            ]
        ]);

        $result_data = json_decode($result->getBody()->getContents());
        $result_data = (array) $result_data;
        $member = $result_data['member'];
        $member = (array) $member;




        if($result_data['status']){

            $tax_id = $member['BusinessCode'];
            $company = Company::where('tax_id','=',$tax_id)->first();
            $member['company'] = $company;
            $member['password'] = $encrypted_pwd;
            Session::put('member',$member);
            return redirect('/');

        }
        else{
            Session::flash('message',$result_data['message']);
            return redirect()->back();
        }



    }

    public function home()
    {
        $data  = [
            'email' => '',
            'pwd' => '',

        ];
        if(Session::get('member')){
            $data['email'] = Session::get('member')['Email'];
            $data['pwd'] = Session::get('member')['password'];
        }
        return view('home',$data);
    }


    public function logout()
    {
        Session::forget('member');
        return redirect()->back();
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
