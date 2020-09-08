<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $table = 'modules';
    protected $guarded = ['id'];


    public function company_permissions()
    {
        return $this->hasMany(CompanyPermission::class);
    }
}
