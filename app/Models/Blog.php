<?php

  

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  

class Blog extends Model

{

    use HasFactory;

    protected $fillable = [

        'Guid', 'Title','TitleAr','Slug','SlugAr','DescriptionAr','Description','MetaTitle','MetaTitleAr','MetaDescription','MetaDescriptionAr','Alt','AltAr','Image','CreatedBy','ModifiedBy','IsEnable'

    ];


    
}