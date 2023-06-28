<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactinfo extends Model
{
      use HasFactory;
    protected $primaryKey = 'Guid';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

  

    protected $fillable = [

        'Guid','Email','Phone','Address','AddressAr','CreatedBy','ModifiedBy'

    ];
}
	