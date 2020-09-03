<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $table = 'votes';
    protected $guarded = ['id'];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function vote_options()
    {
        return $this->hasMany(VoteOption::class);
    }

    public function vote_details()
    {
        return $this->hasMany(VoteDetail::class);
    }

}
