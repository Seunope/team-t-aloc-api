<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\VoteTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function castUpVote($questionID){
        $input['question_flag_id'] = $questionID;

        $vote = Vote::whereQuestion_flag_id($questionID)->get();
        if($vote->isEmpty()){
            $input['up_vote'] = 1;
            $input['down_vote'] = 0;
            $vote = Vote::create($input);
        }else{
            $vote = $vote->first();
            $input['up_vote'] = $vote->up_vote+1;
            Vote::where(['question_flag_id' =>$questionID])->update($input);
        }

        $input2['vote_id'] = $vote->id;
        $input2['vote_by'] = getUserID();
        $input2['type'] = "up";
        flash('You have cast your vote');
        VoteTracker::create($input2);
        return back();
    }

    public function castDownVote($questionID){
        $input['question_flag_id'] = $questionID;

        $vote = Vote::whereQuestion_flag_id($questionID)->get();
        if($vote->isEmpty()){
            $input['up_vote'] = 0;
            $input['down_vote'] = 1;
            Vote::create($input);
        }else{
            $vote = $vote->first();
            $input['down_vote'] = $vote->down_vote+1;
            Vote::where(['question_flag_id' =>$questionID])->update($input);
        }

        $input2['vote_id'] = $vote->id;
        $input2['vote_by'] = getUserID();
        $input2['type'] = "down";
        flash('You have cast your vote');
        VoteTracker::create($input2);

        return back();
    }
}
