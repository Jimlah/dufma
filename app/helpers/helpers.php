<?php
use App\Core\Http\Session;
use App\Models\UsersModel;
use App\Providers\UsersProvider;

function get_notification() {
    $data = Session::getAndRemove('msg')?? '';
    return $data;
}

function get_username($id){
    $data = UsersModel::findByPrimaryKey($id);
    return $data;
}