<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'short_name','long_name','type','Taxpayer','VATNumber','registrationNumber','country',
        'address','Manager','ContactPerson','description','phone','email','messenger','swift_bic','industry',
        'bank','bank_account','companyID'
    ];
}
