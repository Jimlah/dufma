<?php

namespace App\Controllers\Dashboard;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Tools\Auth;
use App\Models\UsersModel;
use App\Providers\UsersProvider;

class OrganizationController extends Controller
{
    public function index(Request $request, Response $response)
    {

        $response->view('/dashboard/organization/index', []);
    }

    public function building(Request $request, Response $response)
    {

        $response->view('/dashboard/organization/building', []);
    }

    public function employee(Request $request, Response $response)
    {
        Auth::user();
        $emp = UsersModel::select()
            ->where('access', UsersProvider::ACCESS_EMPLOYEE)
            ->fetchAll();
        return $response->view('/dashboard/organization/employee', [
            'emp' => $emp
        ]);
    }
}
