<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Http\Request;
use App\Models\AssetModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;

class MapController extends Controller
{
    public function index(Request $request, Response $response)
    {   
        $user = $request->user();
        $assets = AssetModel::select()
            ->where('orgid', $user->id())
            ->andWhere('longitude', '')
            ->fetchAll();
        
        $display_assets = AssetModel::select()
            ->where('orgid', $user->id())
            ->andWhere('longitude', "!=", '')
            ->fetchAll();

        return $response->view('dashboard.organization.map', [
            'assets' => $assets,
            'display_assets' => $display_assets
        ]);
    }

    public function store(Request $request, Response $response)
    {   
        list(
            $asset_id,
            $longitude,
            $latitude
        ) = $request->input('asset, longitude, latitude');

        AssetModel::findByPrimaryKeyAndUpdate($asset_id, [
            'longitude' => $longitude,
            'latitude' => $latitude
        ]);

        return $response->redirect($request->url()->getPath());
    }
}