<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Http\Request;
use Cmfcmf\OpenWeatherMap;
use App\Core\Http\Response;
use App\Core\Http\Controller;


class WeatherController extends Controller
{    
    /**
     * index
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    public function index(Request $request, Response $response)
    {   
        list(
            $latitude,
            $longitude
        ) = $request->input('latitude, longitude');
        $weather = weather(3.939786,7.376736);
        
        return $response->view('dashboard.organization.weather', [
            'weather' => $weather
        ]);
    }
}