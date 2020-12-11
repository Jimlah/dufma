<?php
use App\Core\Http\Session;

function get_notification() {
    $data = Session::getAndRemove('msg')?? '';
    return $data;
}