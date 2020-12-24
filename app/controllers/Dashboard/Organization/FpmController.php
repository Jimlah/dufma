<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Tools\Auth;
use App\Models\AssetModel;

class FpmController extends Controller
{
    public function displayField(Request $request, Response $response)
    {   Auth::user();

        $user = $request->user();
        $field = AssetModel::select()
                ->where('orgid', $user->id())
                ->and('category', 'Field')
                ->fetchAll();

        $response->view('/dashboard/organization/field', [
            'field' => $field
        ]);
    }
}