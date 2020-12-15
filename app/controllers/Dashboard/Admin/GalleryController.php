<?php

namespace App\Controllers\Dashboard\Admin;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Models\GalleryModel;

class GalleryController extends Controller
{
    public function display(Request $request, Response $response)
    {   

        $response->view('/dashboard/admin/gallery',[]);
    }

    public function addGallery(Request $request, Response $response)
    {
        $user = $request->user();
        $image = $request->getUploadedFiles('image');
        $description = $request->input('description');
         $allowable_types = array(
            'jpg',
            'png',
            'gif',
            'webp',
            'tiff',
            'psd',
            'raw',
            'bmp',
            'heif',
            'indd',
            'jpep',
            'svg',
            'ai',
            'esp',
        );

        var_dump($request); die();

        try {
            if(!$image->hasExtensionIn($allowable_types)){
                return $response->withSession('msg', 'Invalid document type')->redirect($request->url()->getPath());
            }
        } catch (\Throwable $th) {
            return $response->withSession('msg', 'No document uploaded')->redirect($request->url()->getPath());
        }

        $token = generate_token(20);

        $filename = concat($token, '.', $image->getExtensionFromName());



        if (!$image->moveTo(concat('/uploads/', $filename))) {
            return $response->withSession('msg', 'Unable to upload document')->redirect($request->url()->getPath());
        }

        GalleryModel::createEntry([
            'image' => $image->getClientFilename(),
            'user_id' => $user->id(),
            'token' => $filename,
            'description' => $description
        ]);

        return $response->withSession('msg', 'File uploded Successfully')->redirect($request->url()->getPath());
    }
}