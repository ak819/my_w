<?php

  

namespace App\Models;

  

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


class PropertyEnquiries extends Model

{

    use HasFactory;
    protected $primaryKey = 'Guid';
    protected $keyType = 'string';
   public $incrementing = false;


  

    protected $fillable = [

        'Guid', 'Name','Email','Phone','Message','CreatedBy','ModifiedBy'

    ];

}