<?php

namespace App\Controllers\Dashboard\Employee;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Core\Tools\Auth;
use App\Models\AssetModel;
use App\Models\ProfileModel;
use App\Models\ReportModel;
use App\Providers\ReportProvider;

class ReportController extends Controller
{
    public function displayFieldActivity(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $orgid = $user->userid();

        $status = [
            ReportProvider::ACTIVITY_STAT_ONGOING => 'Ongoing',
            ReportProvider::ACTIVITY_STAT_COMPLETE => 'Complete'
        ];

        $field = ReportModel::select()
            ->where('orgid', $orgid)
            ->andWhere('category', ReportProvider::CATEGORY_DAILY)
            ->and('type', ReportProvider::TYPE_FIELD)
            ->map()
            ->fetchAll();

        $worker = ProfileModel::select()
            ->where('orgid', $orgid)
            ->map()
            ->fetchAll();

        $asset = AssetModel::select()
            ->where('orgid', $orgid)
            ->and('category', 'Field')
            ->map()
            ->fetchAll();

        $response->view('/dashboard/employee/activity', [
            'name' => 'Field',
            'status' => $status,
            'report' => $field,
            'worker' => $worker,
            'asset' => $asset
        ]);
    }

    public function displayPenActivity(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $orgid = $user->userid();

        $status = [
            ReportProvider::ACTIVITY_STAT_ONGOING => 'Ongoing',
            ReportProvider::ACTIVITY_STAT_COMPLETE => 'Complete'
        ];

        $pen = ReportModel::select()
            ->where('orgid', $orgid)
            ->andWhere('category', ReportProvider::CATEGORY_DAILY)
            ->and('type', ReportProvider::TYPE_PEN)
            ->map()
            ->fetchAll();

        $worker = ProfileModel::select()
            ->where('orgid', $orgid)
            ->map()
            ->fetchAll();

        $asset = AssetModel::select()
            ->where('orgid', $orgid)
            ->and('category', 'Pen')
            ->map()
            ->fetchAll();

        $response->view('/dashboard/employee/activity', [
            'name' => 'Pen',
            'status' => $status,
            'report' => $pen,
            'worker' => $worker,
            'asset' => $asset
        ]);
    }

    public function displayFacilityActivity(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $orgid = $user->userid();

        $status = [
            ReportProvider::ACTIVITY_STAT_ONGOING => 'Ongoing',
            ReportProvider::ACTIVITY_STAT_COMPLETE => 'Complete'
        ];

        $facility = ReportModel::select()
            ->where('orgid', $orgid)
            ->andWhere('category', ReportProvider::CATEGORY_DAILY)
            ->and('type', ReportProvider::TYPE_FACILITY)
            ->map()
            ->fetchAll();

        $worker = ProfileModel::select()
            ->where('orgid', $orgid)
            ->map()
            ->fetchAll();

        $asset = AssetModel::select()
            ->where('orgid', $orgid)
            ->and('category', 'Facility')
            ->map()
            ->fetchAll();

        $response->view('/dashboard/employee/activity', [
            'name' => 'Facility',
            'status' => $status,
            'report' => $facility,
            'worker' => $worker,
            'asset' => $asset
        ]);
    }


    public function displayFieldWeekReport(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $orgid = $user->userid();

        $status = [
            ReportProvider::ACTIVITY_STAT_ONGOING => 'Ongoing',
            ReportProvider::ACTIVITY_STAT_COMPLETE => 'Complete'
        ];

        $field = ReportModel::select()
            ->where('orgid', $orgid)
            ->andWhere('category', ReportProvider::CATEGORY_WEEKLY)
            ->and('type', ReportProvider::TYPE_FIELD)
            ->map()
            ->fetchAll();

        $worker = ProfileModel::select()
            ->where('orgid', $orgid)
            ->map()
            ->fetchAll();

        $asset = AssetModel::select()
            ->where('orgid', $orgid)
            ->and('category', 'Field')
            ->map()
            ->fetchAll();

        $response->view('/dashboard/employee/report', [
            'name' => 'Field',
            'status' => $status,
            'report' => $field,
            'worker' => $worker,
            'asset' => $asset,
            'time' => 'week'
        ]);
    }

    public function displayPenWeekReport(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $orgid = $user->userid();

        $status = [
            ReportProvider::ACTIVITY_STAT_ONGOING => 'Ongoing',
            ReportProvider::ACTIVITY_STAT_COMPLETE => 'Complete'
        ];

        $pen = ReportModel::select()
            ->where('orgid', $orgid)
            ->andWhere('category', ReportProvider::CATEGORY_WEEKLY)
            ->and('type', ReportProvider::TYPE_PEN)
            ->map()
            ->fetchAll();

        $worker = ProfileModel::select()
            ->where('orgid', $orgid)
            ->map()
            ->fetchAll();

        $asset = AssetModel::select()
            ->where('orgid', $orgid)
            ->and('category', 'Pen')
            ->map()
            ->fetchAll();

        $response->view('/dashboard/employee/report', [
            'name' => 'Pen',
            'status' => $status,
            'report' => $pen,
            'worker' => $worker,
            'asset' => $asset,
            'time' => 'week'
        ]);
    }

    public function displayFacilityWeekReport(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $orgid = $user->userid();

        $status = [
            ReportProvider::ACTIVITY_STAT_ONGOING => 'Ongoing',
            ReportProvider::ACTIVITY_STAT_COMPLETE => 'Complete'
        ];

        $facility = ReportModel::select()
            ->where('orgid', $orgid)
            ->andWhere('category', ReportProvider::CATEGORY_WEEKLY)
            ->and('type', ReportProvider::TYPE_FACILITY)
            ->map()
            ->fetchAll();

        $worker = ProfileModel::select()
            ->where('orgid', $orgid)
            ->map()
            ->fetchAll();

        $asset = AssetModel::select()
            ->where('orgid', $orgid)
            ->and('category', 'Facility')
            ->map()
            ->fetchAll();

        $response->view('/dashboard/employee/report', [
            'name' => 'Facility',
            'status' => $status,
            'report' => $facility,
            'worker' => $worker,
            'asset' => $asset,
            'time' => 'week'
        ]);
    }

    public function displayFieldMonthReport(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $orgid = $user->userid();

        $status = [
            ReportProvider::ACTIVITY_STAT_ONGOING => 'Ongoing',
            ReportProvider::ACTIVITY_STAT_COMPLETE => 'Complete'
        ];

        $field = ReportModel::select()
            ->where('orgid', $orgid)
            ->andWhere('category', ReportProvider::CATEGORY_MONTHLY)
            ->and('type', ReportProvider::TYPE_FIELD)
            ->map()
            ->fetchAll();

        $worker = ProfileModel::select()
            ->where('orgid', $orgid)
            ->map()
            ->fetchAll();

        $asset = AssetModel::select()
            ->where('orgid', $orgid)
            ->and('category', 'Field')
            ->map()
            ->fetchAll();

        $response->view('/dashboard/employee/report', [
            'name' => 'Field',
            'status' => $status,
            'report' => $field,
            'worker' => $worker,
            'asset' => $asset,
            'time' => 'month'
        ]);
    }

    public function displayPenMonthReport(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $orgid = $user->userid();

        $status = [
            ReportProvider::ACTIVITY_STAT_ONGOING => 'Ongoing',
            ReportProvider::ACTIVITY_STAT_COMPLETE => 'Complete'
        ];

        $pen = ReportModel::select()
            ->where('orgid', $orgid)
            ->andWhere('category', ReportProvider::CATEGORY_MONTHLY)
            ->and('type', ReportProvider::TYPE_PEN)
            ->map()
            ->fetchAll();

        $worker = ProfileModel::select()
            ->where('orgid', $orgid)
            ->map()
            ->fetchAll();

        $asset = AssetModel::select()
            ->where('orgid', $orgid)
            ->and('category', 'Pen')
            ->map()
            ->fetchAll();

        $response->view('/dashboard/employee/report', [
            'name' => 'Pen',
            'status' => $status,
            'report' => $pen,
            'worker' => $worker,
            'asset' => $asset,
            'time' => 'month'
        ]);
    }

    public function displayFacilityMonthReport(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $orgid = $user->userid();

        $status = [
            ReportProvider::ACTIVITY_STAT_ONGOING => 'Ongoing',
            ReportProvider::ACTIVITY_STAT_COMPLETE => 'Complete'
        ];

        $facility = ReportModel::select()
            ->where('orgid', $orgid)
            ->andWhere('category', ReportProvider::CATEGORY_MONTHLY)
            ->and('type', ReportProvider::TYPE_FACILITY)
            ->map()
            ->fetchAll();

        $worker = ProfileModel::select()
            ->where('orgid', $orgid)
            ->map()
            ->fetchAll();

        $asset = AssetModel::select()
            ->where('orgid', $orgid)
            ->and('category', 'Facility')
            ->map()
            ->fetchAll();

        $response->view('/dashboard/employee/report', [
            'name' => 'Facility',
            'status' => $status,
            'report' => $facility,
            'worker' => $worker,
            'asset' => $asset,
            'time' => 'month'
        ]);
    }

    public function addReport(Request $request, Response $response)
    {
        Auth::user();
        $referer_uri = $request->getServer()->get('http_referer');

        $user = $request->user();
        $userid = $user->id();
        $orgid = $user->userid();

        $time = $request->input('time');
        $assetid = $request->input('assetid');
        $usage_emp = $request->input('usage_emp');
        $usage_hr = $request->input('usage_hr');
        $activity = $request->input('activity');
        $activity_status = $request->input('activity_status');
        $asset_status = $request->input('asset_status');
        $manager = $request->input('manager');


        $url = $request->url()->getPath();

        switch ($url) {
            case '/dashboard/employee/fieldactivity':
                $type = ReportProvider::TYPE_FIELD;
                $category = ReportProvider::CATEGORY_DAILY;
                break;
            case '/dashboard/employee/facilityactivity':
                $type = ReportProvider::TYPE_FACILITY;
                $category = ReportProvider::CATEGORY_DAILY;
                break;
            case '/dashboard/employee/penactivity':
                $type = ReportProvider::TYPE_PEN;
                $category = ReportProvider::CATEGORY_DAILY;
                break;
            case '/dashboard/employee/fieldweek':
                $type = ReportProvider::TYPE_FIELD;
                $category = ReportProvider::CATEGORY_WEEKLY;
                break;
            case '/dashboard/employee/penweek':
                $type = ReportProvider::TYPE_PEN;
                $category = ReportProvider::CATEGORY_WEEKLY;
                break;
            case '/dashboard/employee/facilityweek':
                $type = ReportProvider::TYPE_FACILITY;
                $category = ReportProvider::CATEGORY_WEEKLY;
                break;
            case '/dashboard/employee/fieldmonth':
                $type = ReportProvider::TYPE_FIELD;
                $category = ReportProvider::CATEGORY_MONTHLY;
                break;
            case '/dashboard/employee/penmonth':
                $type = ReportProvider::TYPE_PEN;
                $category = ReportProvider::CATEGORY_MONTHLY;
                break;
            case '/dashboard/employee/facilitymonth':
                $type = ReportProvider::TYPE_FACILITY;
                $category = ReportProvider::CATEGORY_MONTHLY;
                break;
        }



        InputValidator::init();

        $time->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($url);
        }


        ReportModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'time' => $time,
            'assetid' => $assetid,
            'usage_emp' => $usage_emp,
            'usage_hr' => $usage_hr,
            'activity' => $activity,
            'activity_status' => $activity_status,
            'asset_status' => $asset_status,
            'manager' => $manager,
            'type' => $type,
            'category' => $category
        ]);

        $msg = "You have successfully added to the database";

        return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
    }

    public function updateReport(Request $request, Response $response)
    {
        Auth::user();
        $referer_uri = $request->getServer()->get('http_referer');

        $id = $request->url()->getQuery('id');


        $time = $request->input('time');
        $assetid = $request->input('assetid');
        $usage_emp = $request->input('usage_emp');
        $usage_hr = $request->input('usage_hr');
        $activity = $request->input('activity');
        $activity_status = $request->input('activity_status');
        $asset_status = $request->input('asset_status');
        $manager = $request->input('manager');

        ReportModel::findByPrimaryKeyAndUpdate($id, [
            'time' => $time,
            'assetid' => $assetid,
            'usage_emp' => $usage_emp,
            'usage_hr' => $usage_hr,
            'activity' => $activity,
            'activity_status' => $activity_status,
            'asset_status' => $asset_status,
            'manager' => $manager,
        ]);

        $msg = "You have successfully updated the database";

        return $response->withSession('msg', [$msg, 'alert'])->redirect($referer_uri, [], true);
    }

    public function delete(Request $request, Response $response)
    {
        $referer_uri = $request->getServer()->get("http_referer");

        $id = $request->input('id');


        ReportModel::findByPrimaryKeyAndRemove($id);

        $msg = 'You have deleted successfully';
        return $response->withSession('msg', [$msg, 'alert'])->redirect($referer_uri, [], true);
    }
}
