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
        $gallery = GalleryModel::select()
                    ->fetchAll();

        $response->view('/dashboard/admin/gallery',[
            'gallery' => $gallery
        ]);
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

        try {
            if(!$image->hasExtensionIn($allowable_types)){
                $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Invalid document type
            </div>';
                return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
            }
        } catch (\Throwable $th) {
            $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Invalid document type 
            </div>';
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
        }

        $token = generate_token(20);

        $filename = concat($token, '.', $image->getExtensionFromName());



        if (!$image->moveTo(concat('/uploads/', $filename))) {
            $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Unable to upload document
            </div>';
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
        }

        GalleryModel::createEntry([
            'image' => $image->getClientFilename(),
            'user_id' => $user->id(),
            'token' => $filename,
            'description' => $description
        ]);

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                File uploded Successfully
            </div>';

        return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
    }

    public function delete(Request $request, Response $response)
    {

        $id = $request->input('id');


        GalleryModel::findByPrimaryKeyAndRemove($id);

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully Deleted
            </div>';

        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        return $response->withSession('msg', $msg)->redirect($url);
    }
}