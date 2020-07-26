<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function callYoutubeApi($keyword) {
        $url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&key=';
         $key = 'AIzaSyDc8Dn34ikz5xw5z4yngW1JOyJKDn5X4tc'; /** alternative key */
       // $key = 'AIzaSyD0ANuXFwZJtW0dSsqN70Kt9tdJ3wC1HnU';
       
        return  Http::get($url . $key . '&q=' . $keyword)->json();
     }

  
}
