<?php

namespace App\Controllers\Landing;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Models\GalleryModel;
use App\Core\Http\Controller;

class MediaController extends Controller
{
    public function display(Request $request, Response $response)
    {   
        $gallery = GalleryModel::select()
                    ->fetchAll();

        $response->view('/landing/media',[
            'gallery' => $gallery
        ]);
    }
}