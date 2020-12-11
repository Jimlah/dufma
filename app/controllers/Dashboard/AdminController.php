<?php

namespace App\Controllers\Dashboard;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;

class AdminController extends Controller
{
    public function index(Request $request, Response $response)
    {   

        $response->view('/dashboard/admin/index',[]);
    }

    public function organization(Request $request, Response $response)
    {   
        $response->view('/dashboard/admin/organization',[]);
    }
}