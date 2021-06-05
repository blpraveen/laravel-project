<?php

namespace App\Http\Services;

use App\Http\Services\Communication; 
use Carbon\Carbon;
class Metrics extends Communication
{ 


	public function __construct()
    {
        
        parent::__construct();
       
        
    }

	public function getWeather()
    {
        try {
        	$weatherAPI = Config('thirdparties.weather');
        	$this->thirdPartiesId = 'weather';
	        $this->url = $weatherAPI['url']."?id=".$weatherAPI['city_id']."&lang=en&units=metric&appid=".$weatherAPI['api_key']; 
    		return $response = $this->get();    
        } catch (\Exception $e) {
            \Log::error($e);
        }
    }

}