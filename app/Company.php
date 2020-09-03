<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //

    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $table = 'companies';
    protected $guarded = ['id'];

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }


}
