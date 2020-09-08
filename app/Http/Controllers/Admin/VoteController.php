<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use App\Order;
use App\User;
use App\Vote;
use App\VoteDetail;
use App\VoteOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = Vote::query();
        $sortBy_text = ['建立日期', '截止日期'];

        $date_from = now()->subDays(7)->format('Y-m-d');
        $date_to = now()->format('Y-m-d');
        $search_type = 0;
        $search_info = '';
        $sortBy = 'create_date';
        $is_active = -1;

        if(Auth::user()->level != 2){
            $query->where('company_id','=',Auth::user()->company->id);
        }

        if ($request->has('sortBy')) {
            $sortBy = $request->input('sortBy');
        }

        if ($request->has('is_active')) {
            $is_active = $request->input('is_active');
        }
        if ($is_active >= 0) {
            $query->where('is_active', '=', $is_active);
        }


        if ($request->has('date_from')) {
            $date_from = $request->input('date_from');
        }
        if ($request->has('date_to')) {
            $date_to = $request->input('date_to');
        }
        if ($date_from != null && $date_to != null) {
            $date_from_addtime = $date_from . " 00:00:00";
            $date_to_addtime = $date_to . " 23:59:59";
            $query->whereBetween( $sortBy, [$date_from_addtime, $date_to_addtime]);
        }

        if ($request->has('search_type')) {
            $search_type = $request->query('search_type');
        }
        if ($search_type > 0) {
            $search_info = $request->query('search_info');
            switch ($search_type) {
                case 1:
                    $query->where('title', 'like', "%{$search_info}%");
                    break;

                default:
                    break;
            }
        }


        $query->orderBy($sortBy, 'DESC');
        $votes = $query->paginate(15);
        $data = [
            'votes' => $votes,
            'date_to' => $date_to,
            'date_from' => $date_from,
            'search_type' => $search_type,
            'search_info' => $search_info,
            'sortBy' => $sortBy,
            'sortBy_text' => $sortBy_text,
            'is_active' => $is_active,
        ];
        return view('admin.vote.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        return view('admin.vote.create');
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
//        dd($request);

        $this->validate($request, [
            'type' => 'required',
            'option_type' => 'required',
            'title' => 'required',
            'options.*' => 'required',

        ]);

        $vote = Vote::create([
            'title' => $request->input('title'),
            'company_id' => Auth::user()->company->id,
            'user_id' => Auth::user()->id,
            'type' => $request->input('type'),
            'option_type' => $request->input('option_type'),
            'deadline' => $request->input('deadline'),
            'create_date' => now(),
            'update_date' => now(),
            'is_active'=> now(),
        ]);

        $options = $request->input('options');
        $img_files = $request->file('image_url');
        $has_images = $request->input('has_image');

        $count = 0;
        foreach ($options as $option) {
            $vote_option = VoteOption::create([
                'name' => $option,
                'create_date' => now(),
                'update_date' => now(),
                'vote_id' => $vote->id,
            ]);

            if ($vote->option_type == 1) {
                if ($has_images[$count] == 1) {
                    $file = $img_files[$count];
                    $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/vote_imgs/', $file_name);
                    $vote_option->image_url = '/vote_imgs/' . $file_name;

                } else {
                    $vote_option->image_url = '/vote_imgs/default.png';
                }
                $vote_option->update();
            }
            $count += 1;
        }


        return redirect()->route('admin_vote.index');
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
    public function edit(Vote $vote, Request $request)
    {
        //


        $data = [
            'vote' => $vote,
            'source_html' => $request->input('source_html'),
        ];

        return view('admin.vote.edit', $data);
    }

    public function vote(Vote $vote,Request $request)
    {
        $data = [
            'vote' => $vote,
            'source_html' => $request->input('source_html'),
        ];

        return view('admin.vote.vote', $data);
    }

    public function submitVote(Vote $vote , Request  $request)
    {
        $this->validate($request, [
            'choice' => 'required',
        ]);

        foreach ($request->input('choice') as $option_id => $on){

            VoteDetail::create([
                'vote_id' => $vote->id,
                'user_id' => Auth::user()->id,
                'vote_option_id'=> $option_id,
                'create_date' => now(),
                'update_date' => now(),
            ]);
        }


        return redirect()->route('admin_vote.result',$vote->id);

    }

    public function result(Vote $vote)
    {

        $results = [];
        foreach($vote->vote_options as $vote_option){
            if(!array_key_exists($vote_option->id, $results)){
                $total = count(VoteDetail::where('vote_id','=',$vote->id)->get());
                $results[$vote_option->id]['option_name'] = $vote_option->name;
                $results[$vote_option->id]['img'] = $vote_option->image_url;

                if($total != 0){
                    $results[$vote_option->id]['count'] = count(VoteDetail::where('vote_option_id','=',$vote_option->id)
                        ->get());
                    $results[$vote_option->id]['percentage'] = $results[$vote_option->id]['count']/$total;

                }
                else{
                    $results[$vote_option->id]['count'] = 0;
                    $results[$vote_option->id]['percentage'] = 0;
                }

                if($results[$vote_option->id]['percentage']>=0.5){
                    $results[$vote_option->id]['class'] = 'btn btn-sm btn-success';
                }
                if($results[$vote_option->id]['percentage'] < 0.5){
                    $results[$vote_option->id]['class'] = 'btn btn-sm btn-warning';
                }
                if($results[$vote_option->id]['percentage'] <= 0.1){
                    $results[$vote_option->id]['class'] = 'btn btn-sm btn-danger';
                }

            }
        }

//        dd($results);

        $data = [
            'vote' => $vote,
            'results' => $results,
        ];

        return view('admin.vote.result',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        //
        $vote->title = $request->input('title');
        $vote->type = $request->input('type');
        $vote->option_type = $request->input('option_type');
        $vote->deadline = $request->input('deadline');
        $vote->is_active = $request->input('is_active');
        $vote->update_date = now();
        $vote->update();

        $options = $request->input('options');
        $img_files = $request->file('image_url');
        $has_images = $request->input('has_image');
        $old_image = $request->input('old_image');

        if ($img_files) {
            $img_files = array_values($img_files);
        }


        $old_option_count = count($vote->vote_options);
        $new_option_count = count($options);

        if ($old_option_count == $new_option_count) {
//            可能有更新
            $i = 0;
            $image_count = 0;
            foreach ($vote->vote_options as $vote_option) {
                $vote_option->name = $options[$i];
                $vote_option->update_date = now();
                if ($has_images[$i] == 1 && $vote->option_type == 1) {
                    $file = $img_files[$image_count];
                    $image_count += 1;
                    $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/vote_imgs/', $file_name);
                    $vote_option->image_url = '/vote_imgs/' . $file_name;
                }
                else if ($has_images[$i] == 0 && $vote->option_type == 1) {
                    $vote_option->image_url = $old_image[$i];
                }
                else if($vote->option_type == 0){
                    $vote_option->image_url = '/vote_imgs/default.png';
                }

                $vote_option->update();
                $i += 1;
            }
        } else if ($old_option_count < $new_option_count) {
//           更新
            if ($img_files) {
                $img_files = array_values($img_files);
            }
            $i = 0;
            $image_count = 0;
            foreach ($vote->vote_options as $vote_option) {
                $vote_option->name = $options[$i];
                $vote_option->update_date = now();
                if ($has_images[$i] == 1 && $vote->option_type == 1) {
                    $file = $img_files[$image_count];
                    $image_count += 1;
                    $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/vote_imgs/', $file_name);
                    $vote_option->image_url = '/vote_imgs/' . $file_name;
                }
                else if ($has_images[$i] == 0 && $vote->option_type == 1) {
                    $vote_option->image_url = $old_image[$i];
                }
                else if($vote->option_type == 0){
                    $vote_option->image_url = '/vote_imgs/default.png';
                }
                $vote_option->update();
                $i += 1;
            }
//            新增
            for ($i = $old_option_count; $i < $new_option_count; $i++) {
                $vote_option = VoteOption::create([
                    'name' => $options[$i],
                    'create_date' => now(),
                    'update_date' => now(),
                    'vote_id' => $vote->id,
                ]);
                if ($has_images[$i] == 1 && $vote->option_type == 1) {
                    $file = $img_files[$image_count];
                    $image_count += 1;
                    $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/vote_imgs/', $file_name);
                    $vote_option->image_url = '/vote_imgs/' . $file_name;
                    $vote_option->update();
                } else if ($has_images[$i] == 0 && $vote->option_type == 1) {
                    $vote_option->image_url = '/vote_imgs/default.png';
                    $vote_option->update();
                }
                else if($vote->option_type == 0){
                    $vote_option->image_url = '/vote_imgs/default.png';
                }
            }

        } else {
//            有刪除
            $image_count = 0;
            for ($i = 0; $i < $new_option_count; $i++) {
                $vote_option = $vote->vote_options[$i];
                $vote_option->name = $options[$i];
                $vote_option->update_date = now();
                if ($has_images[$i] == 1 && $vote->option_type == 1) {
                    $file = $img_files[$image_count];
                    $image_count += 1;
                    $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/vote_imgs/', $file_name);
                    $vote_option->image_url = '/vote_imgs/' . $file_name;
                }
                else if ($has_images[$i] == 0 && $vote->option_type == 1) {
                    $vote_option->image_url = $old_image[$i];
                }
                else if($vote->option_type == 0){
                    $vote_option->image_url = '/vote_imgs/default.png';
                }
                $vote_option->update();
                $i += 1;
            }
            for ($i = $new_option_count; $i < $old_option_count; $i++) {
                $vote_option = $vote->vote_options[$i];
                $vote_option->delete();
            }
        }

        return redirect()->route('admin_vote.index');

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
