<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Services\Metrics;
class HomeController
{
	protected $metric;
	public function __construct()
    {
        $this->metric = new Metrics();
    }
    public function index()
    {	
    	$weather = $this->metric->getWeather();
    	$categories = Category::all();
        return view('admin.home',compact('categories','weather'));
    }
}
