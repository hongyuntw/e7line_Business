<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteOption extends Model
{
    //
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $table = 'vote_options';
    protected $guarded = ['id'];


    public function vote()
    {
        return $this->belongsTo(Vote::class);
    }

}
