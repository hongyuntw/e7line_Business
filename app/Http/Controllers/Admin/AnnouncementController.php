<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //

        $query = Announcement::query();
        $query->orderBy('create_date','DESC');
        $announcements = $query->paginate(15);
        $data = [
            'announcements' =>$announcements
        ];

        return view('admin.announcement.index',$data);

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
            'companies' => $companies,
        ];

        return view('admin.announcement.create',$data);
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
            'type' => 'required',
            'content' => 'required',
            'title' => 'required',
        ]);


        $new_ann = Announcement::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id'=> Auth::user()->id,
            'company_id' => Auth::user()->company->id,
            'type' => $request->input('type'),
            'create_date' => now(),
            'update_date' => now(),
        ]);

        return redirect()->route('admin_announcement.index');


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
    public function edit(Announcement $announcement , Request $request)
    {
        //
//        dd($request);
//        dd($announcement);
        $data = [
            'announcement' => $announcement,
            'source_html' => $request->input('source_html'),
        ];

        return view('admin.announcement.edit' , $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
        $this->validate($request, [
            'type' => 'required',
            'content' => 'required',
            'title' => 'required',
        ]);

        $announcement->type = $request->input('type');
        $announcement->content = $request->input('content');
        $announcement->title = $request->input('title');
        $announcement->update_date = now();
        $announcement->update();

//        return Redirect::to();
        return redirect()->to($request->input('source_html'));




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
