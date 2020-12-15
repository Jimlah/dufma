<?php
use App\Core\Http\Session;
use App\Models\UsersModel;
use App\Providers\UsersProvider;

function get_notification() {
    $data = Session::getAndRemove('msg')?? '';
    return $data;
}

function get_user($id){
    $data = UsersModel::select()
                        ->where('id', $id)
                        ->fetchOne();
    return $data;
}

function dnd ($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}