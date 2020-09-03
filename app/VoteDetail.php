<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteDetail extends Model
{
    //

    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $table = 'vote_details';
    protected $guarded = ['id'];

    public function vote()
    {
        return $this->belongsTo(Vote::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vote_option()
    {
        return $this->belongsTo(VoteOption::class);
    }
}
