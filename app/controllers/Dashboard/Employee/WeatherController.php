<?php

namespace App\Controllers\Dashboard\Employee;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;

class WeatherController extends Controller
{
    public function index(Request $request, Response $response)
    {   
        list(
            $latitude,
            $longitude
        ) = $request->input('latitude, longitude');
        $weather = weather(3.939786,7.376736);
        // dnd($weather->daily);
        return $response->view('dashboard.organization.weather', [
            'weather' => $weather
        ]);
    }
}