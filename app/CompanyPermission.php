<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyPermission extends Model
{
    //
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $table = 'company_permissions';
    protected $guarded = ['id'];


    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
