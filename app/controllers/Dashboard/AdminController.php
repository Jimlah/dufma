<?php

namespace App\Controllers\Dashboard;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Tools\Auth;
use App\Models\UsersModel;
use App\Providers\UsersProvider;

class AdminController extends Controller
{
    public function index(Request $request, Response $response)
    {   

        $response->view('/dashboard/admin/index',[]);
    }

    public function organization(Request $request, Response $response)
    {   
        Auth::user();
        $org = UsersModel::select()
                            ->where('access', UsersProvider::ACCESS_ORGANIZATION)
                            ->fetchAll();
        return $response->view('/dashboard/admin/organization',[
            'org' => $org
        ]);
    }
}