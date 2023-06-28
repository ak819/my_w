<?php

  

namespace App\Models;

  

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


class testimonials extends Model

{

    use HasFactory;
    protected $primaryKey = 'Guid';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

  

    protected $fillable = [

        'Guid','CustomerName','CustomerNameAr','Rating','Message','MessageAr','Photo','Designation','DesignationAr','IsEnable','CreatedBy','ModifiedBy'

    ];

}