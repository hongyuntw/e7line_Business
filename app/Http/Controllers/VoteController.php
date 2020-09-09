<?php

namespace App\Http\Controllers;

use App\Company;
use App\Vote;
use App\VoteDetail;
use App\VoteOption;
use Illuminate\Http\Request;
use Session;

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
        if (!Session::get('member')) {
            Session::flash('message','投票功能必須登入！');
            return redirect()->back();
        }

        $search_info = '';
        if($request->has('search_info')){
            $search_info = $request->input('search_info');
        }


        $tax_id = Session::get('member')['BusinessCode'];
        $company = Company::where('tax_id', '=', $tax_id)->first();
        $company_id = 0;
        if ($company) {
            $company_id = $company->id;
        }


        $open_query = Vote::query();
        $close_query = Vote::query();

//        $open_query->where('company_id','=',$company_id)
        $open_query->where('is_active', '=', 1)
            ->where('deadline', '>', now());

//        $close_query->where('company_id','=',$company_id)
        $close_query->where('is_active', '=', 1)
            ->where('deadline', '<=', now());

        if($search_info != ''){
            $open_query->where('title', 'like', "%{$search_info}%");
            $close_query->where('title', 'like', "%{$search_info}%");
        }

        $open_votes = $open_query->orderBy('deadline','ASC')->get();
        $close_votes = $close_query->orderBy('deadline','DESC')->get();
        $close_result = [];

        foreach ($close_votes as $vote){
            $option_id = \App\VoteDetail::where('vote_id','=',$vote->id)
                ->select('vote_option_id')
                ->groupBy('vote_option_id')
                ->orderByRaw('COUNT(*) DESC')
                ->first()->vote_option_id;
            $vote_option = VoteOption::find($option_id);
            $close_result[$vote->id] = $vote_option;
        }



        $data = [
            'open_votes' => $open_votes,
            'close_votes' => $close_votes,
            'close_result' => $close_result,
            'search_info'=> $search_info,
        ];

        return view('vote', $data);
    }


    public function detail()
    {
        return view('voteDetailImg');
    }

    public function voting(Request $request, Vote $vote)
    {
        $email = Session::get('member')['Email'];
        $old_option_ids = VoteDetail::where('email', '=', $email)->pluck('vote_option_id')->toArray();

        $data = [
            'vote' => $vote,
            'old_option_ids' => $old_option_ids,
        ];


        if ($vote->option_type == 1) {
            return view('voteDetailImg', $data);
        } else {
            return view('voteDetail', $data);
        }


    }


    public function submit(Request $request, Vote $vote)
    {


        $email = Session::get('member')['Email'];
        if ($vote->type == 0) {
//            單選
            $choices = $request->input('choice');

            if(is_null($choices)){
                $vote_detail = VoteDetail::where('email', '=', $email)->where('vote_id', '=', $vote->id)->first();
                if ($vote_detail) {
                    $vote_detail->delete();
                }
                return redirect('/vote');
            }



            foreach ($choices as $option_id => $on) {
                $vote_detail = VoteDetail::where('email', '=', $email)->where('vote_id', '=', $vote->id)->first();
                if ($vote_detail) {
                    $vote_detail->vote_option_id = $option_id;
                    $vote_detail->update_date = now();
                    $vote_detail->update();
                } else {
                    VoteDetail::create([
                        'vote_id' => $vote->id,
                        'email' => $email,
                        'vote_option_id' => $option_id,
                        'create_date' => now(),
                        'update_date' => now(),
                    ]);
                }
                return redirect('/vote');

            }
        } else {
            $choices = $request->input('choice');
            if (!$choices) {
                $choices = array();
            }
            $old_vote_details = VoteDetail::where('email', '=', $email)->where('vote_id', '=', $vote->id)->get();
            $old_vote_details_count = count(VoteDetail::where('email', '=', $email)->where('vote_id', '=', $vote->id)->get());
            $choice_count = count($choices);


            if ($old_vote_details_count == 0) {
                foreach ($choices as $option_id => $on) {
                    VoteDetail::create([
                        'vote_id' => $vote->id,
                        'email' => $email,
                        'vote_option_id' => $option_id,
                        'create_date' => now(),
                        'update_date' => now(),
                    ]);

                }
                return redirect('/vote');
            }


            if ($old_vote_details_count == $choice_count) {
                $i = 0;
                foreach ($choices as $option_id => $on) {
                    $vote_detail = $old_vote_details[$i];
                    $vote_detail->vote_option_id = $option_id;
                    $vote_detail->update_date = now();
                    $vote_detail->update();
                    $i += 1;
                }
            } else if ($old_vote_details_count > $choice_count) {
                $i = 0;
                foreach ($choices as $option_id => $on) {
                    $vote_detail = $old_vote_details[$i];
                    $vote_detail->vote_option_id = $option_id;
                    $vote_detail->update_date = now();
                    $vote_detail->update();
                    $i += 1;
                }
                for ($i = $choice_count; $i < $old_vote_details_count; $i++) {
                    $vote_detail = $old_vote_details[$i];
                    $vote_detail->delete();
                }

            } else if ($old_vote_details_count < $choice_count) {
                $i = 0;
                foreach ($choices as $option_id => $on) {
                    if ($i >= $old_vote_details_count) {
//                        新增
                        VoteDetail::create([
                            'vote_id' => $vote->id,
                            'email' => $email,
                            'vote_option_id' => $option_id,
                            'create_date' => now(),
                            'update_date' => now(),
                        ]);
                        $i += 1;
                    } else {
                        $vote_detail = $old_vote_details[$i];
                        $vote_detail->vote_option_id = $option_id;
                        $vote_detail->update_date = now();
                        $vote_detail->update();
                        $i += 1;

                    }

                }

            }

            return redirect('/vote');
        }

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
