<?php

namespace App\Controllers\Dashboard;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Tools\Auth;

class FunctionController extends Controller
{
    public function logout(Request $request, Response $response)
    {   
        Auth::logout();
        return $response->redirect('/');
    }
}