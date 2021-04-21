<?php

function weather($lng, $lat)
{
    $apiKey = env('WEATHER_API');
    $cityId = "CITY ID";
    $googleApiUrl = "https://api.openweathermap.org/data/2.5/onecall?lat=${lat}&lon=${lng}&appid=$apiKey";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response);
    $currentTime = time();
    return $data;
}
