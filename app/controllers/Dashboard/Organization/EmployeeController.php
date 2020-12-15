<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Models\UsersModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Providers\UsersProvider;

class EmployeeController extends Controller
{
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