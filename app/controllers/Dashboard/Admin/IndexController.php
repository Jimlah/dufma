<?php

namespace App\Controllers\Dashboard\Admin;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;

class IndexController extends Controller
{
    public function display(Request $request, Response $response)
    {   

        $response->view('/dashboard/admin/index',[]);
    }

    

    

    
}