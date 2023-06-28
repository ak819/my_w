<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seourl extends Model
{
    protected $primaryKey = 'Guid';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    use HasFactory;

    protected $guarded = [];  

}
