<?php

namespace App\Middlewares;

use App\Core\Http\Request;
use App\Models\AssetModel;
use App\Core\Interfaces\MiddlewareInterface;
use App\Models\WarehouseModel;

class CheckuserMiddleware implements MiddlewareInterface
{
    /**
    * Trigger middleware event
    *
    * @param Request $request
    * @param array|null $args
    * @return mixed
    */
    public function trigger(Request $request, ?array $args = null)
    {   
        $referer_uri = $request->getServer()->get('http_referer');

        [$type] = $args;
        $id = $request->getMethod() === 'get'
                ? $request->url()->getQuery('id')
                : $request->input('id')->getValue();

        $is_warehouse = $type === 'warehouse';
        $userid = $is_warehouse
                    ? AssetModel::findByPrimaryKey($id)->userid
                    : WarehouseModel::findByPrimaryKey($id)->userid;

        if($userid != $request->user()->id()) {
            $msg = 'You do not have right to access resource';
            return response()->withSession('msg', [$msg, 'alert'])->redirect($referer_uri, [], true);
        }

        return $request;
    }
}