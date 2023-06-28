<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsImages extends Model
{
    use HasFactory;

    protected $primaryKey = 'Guid';
    protected $keyType = 'string';
    public $incrementing = false;



  

    protected $fillable = [

        'Guid','Alt','Image','IsEnable','CreatedBy','ModifiedBy'

    ];

}
