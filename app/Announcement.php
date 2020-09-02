<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $table = 'announcements';
    protected $guarded = ['id'];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
