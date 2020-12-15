<?php

namespace App\Controllers\Dashboard\Admin;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Tools\Auth;

class IndexController extends Controller
{
    public function display(Request $request, Response $response)
    {   
        Auth::user();
        $response->view('dashboard/admin/index');
    }

    

    

    
}