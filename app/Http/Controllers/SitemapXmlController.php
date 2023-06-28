<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Services;
use App\Models\Property;

class SitemapXmlController extends Controller
{
    public function index() {
        $blogs =  Blog::where('IsEnable', 1)->get(['Slug','SlugAr','CreatedDate']);
        $services=Services::where('IsEnable', 1)->get(['Slug','SlugAr','CreatedDate']);
        $properties=Property::where('properties.IsEnable', 1)
        ->Join('propety_agents as pa', 'pa.ID', '=', 'properties.AgentID')
        ->get(['Slug','SlugAr','Plural','PluralAr','AdType','properties.CreatedDate','PropertyRefNo']);
        return response()->view('sitemap', [
            'blogs' => $blogs,
            'services'=>$services,
            'properties'=>$properties

        ])->header('Content-Type', 'text/xml');
      }
}
