<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    protected $primaryKey = 'Guid';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    //const CREATED_AT = 'CreatedDate';
    //const UPDATED_AT = 'ModifiedDate';
    protected $fillable  = ['Guid','CountryID','CityName','CityNameAr','IsEnable'];

}
