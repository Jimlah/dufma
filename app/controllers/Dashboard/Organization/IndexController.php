<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Models\UsersModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Providers\UsersProvider;

class IndexController extends Controller
{
    public function dispaly(Request $request, Response $response)
    {

        $response->view('/dashboard/organization/index', []);
    }



}