<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Core\Tools\Auth;
use App\Models\AssetModel;
use App\Models\FpmModel;
use App\Providers\FpmProvider;

class FpmController extends Controller
{
    public function displayField(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $field = AssetModel::select()
            ->where('orgid', $user->id())
            ->and('category', 'Field')
            ->fetchAll();

        $fpm = FpmModel::select()
            ->where('orgid', $user->id())
            ->and('fpm', FpmProvider::FPM_FIELD)
            ->map()
            ->fetchAll();

        $response->view('/dashboard/organization/field', [
            'field' => $field,
            'fpm' => $fpm
        ]);
    }

    public function displayPen(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $pen = AssetModel::select()
            ->where('orgid', $user->id())
            ->and('category', 'Pen')
            ->fetchAll();

        $fpm = FpmModel::select()
            ->where('orgid', $user->id())
            ->and('fpm', FpmProvider::FPM_PEN)
            ->map()
            ->fetchAll();

        $response->view('/dashboard/organization/pen', [
            'pen' => $pen,
            'fpm' => $fpm
        ]);
    }

    public function displayFacility(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $facility = AssetModel::select()
            ->where('orgid', $user->id())
            ->and('category', 'Facility')
            ->fetchAll();

        $fpm = FpmModel::select()
            ->where('orgid', $user->id())
            ->and('fpm', FpmProvider::FPM_FACILITY)
            ->map()
            ->fetchAll();

        $response->view('/dashboard/organization/facility', [
            'facility' => $facility,
            'fpm' => $fpm
        ]);
    }

    public function addFpm(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $userid = $user->id();
        $orgid = $user->id();
        $assetid = $request->input('assetid');
        $soil_type = $request->input('soil_type');
        $ph = $request->input('ph');
        $active = $request->input('active');
        $cur_util = $request->input('cur_util');
        $chemical = $request->input('chemical');
        $start_season = $request->input('start_season');
        $end_season = $request->input('end_season');
        $ownership = $request->input('ownership');
        $fallow_period = $request->input('fallow_period');
        $manager = $request->input('manager');
        $capacity = $request->input('capacity');
        $type = $request->input('type');
        $purpose = $request->input('purpose');
        $status = $request->input('status');

        if ($request->url()->getPath() == "/dashboard/organization/field") {
            $fpm = FpmProvider::FPM_FIELD;
        }

        if ($request->url()->getPath() == "/dashboard/organization/pen") {
            $fpm = FpmProvider::FPM_PEN;
        }

        if ($request->url()->getPath() == "/dashboard/organization/facilty") {
            $fpm = FpmProvider::FPM_FACILITY;
        }

        InputValidator::init();

        $assetid->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }


        $check = FpmModel::findBy('assetid', $assetid);

        if ($check) {
            $msg = "You have inputed the field";
            return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getpath());
        }


        FpmModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'assetid' => $assetid,
            'soil_type' => $soil_type,
            'ph' => $ph,
            'active' => $active,
            'cur_util' => $cur_util,
            'chemical' => $chemical,
            'start_season' => $start_season,
            'end_season' => $end_season,
            'ownership' => $ownership,
            'fallow_period' => $fallow_period,
            'manager' => $manager,
            'capacity' => $capacity,
            'type' => $type,
            'purpose' => $purpose,
            'status' => $status,
            'fpm' => $fpm,
        ]);

        $msg = "You have successfully updated your data";
        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getpath());
    }

    public function updateFpm(Request $request, Response $response)
    {
        $referer_uri = $request->getServer()->get('http_referer');
        Auth::user();
        $id = $request->url()->getQuery('id');
        $soil_type = $request->input('soil_type');
        $ph = $request->input('ph');
        $active = $request->input('active');
        $cur_util = $request->input('cur_util');
        $chemical = $request->input('chemical');
        $start_season = $request->input('start_season');
        $end_season = $request->input('end_season');
        $ownership = $request->input('ownership');
        $fallow_period = $request->input('fallow_period');
        $manager = $request->input('manager');
        $capacity = $request->input('capacity');
        $type = $request->input('type');
        $purpose = $request->input('purpose');
        $status = $request->input('status');

        FpmModel::findByPrimaryKeyAndUpdate($id, [
            'soil_type' => $soil_type,
            'ph' => $ph,
            'active' => $active,
            'cur_util' => $cur_util,
            'chemical' => $chemical,
            'start_season' => $start_season,
            'end_season' => $end_season,
            'ownership' => $ownership,
            'fallow_period' => $fallow_period,
            'manager' => $manager,
            'capacity' => $capacity,
            'type' => $type,
            'purpose' => $purpose,
            'status' => $status,
        ]);

        $msg = "You have successfully updated your data";
        return $response->withSession('msg', [$msg, 'alert'])->redirect($referer_uri);
    }

    public function deleteFpm(Request $request, Response $response)
    {
        $referer_uri = $request->getServer()->get('http_referer');
        Auth::user();
        $id = $request->input('id');
        FpmModel::findByPrimaryKeyAndRemove($id);
        $msg = "You have successfully deleted your data";
        return $response->withSession('msg', [$msg, 'alert'])->redirect($referer_uri);
    }
}
