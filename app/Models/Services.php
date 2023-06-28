<?php

  

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  

class Services extends Model

{

    use HasFactory;

    protected $fillable = [

        'Guid','Slug','SlugAr','SubHeading','SubHeadingAr','Title','Description', 'TitleAr','DescriptionAr', 'MetaTitle','MetaDescription', 'MetaTitleAr','MetaDescriptionAr','Image','CreatedBy','ModifiedBy','IsEnable','Alt'

    ];

    
}