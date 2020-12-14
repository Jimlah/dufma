<?php

namespace App\Controllers\Dashboard\Admin;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Models\UsersModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Providers\UsersProvider;

class OrganizationController extends Controller
{
    public function display(Request $request, Response $response)
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