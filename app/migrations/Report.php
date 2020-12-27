<?php

namespace App\Migrations;

use App\Core\Interfaces\MigrationInterface;
use App\Core\Modules\DB;
use App\Core\Modules\Db\DBTableBuilder;

class Report implements MigrationInterface
{
    private const NAME = 'report';

    /**
     * Action to create migration
     *
     * @return void
     */
    public static function up()
    {
        DB::table(self::NAME)
            ->create(function (DBTableBuilder $table) {
                $table->field('id')->int()->increment();
                $table->field('userid')->int();
                $table->field('orgid')->int();
                $table->field('type')->varchar();
                $table->field('usage_emp')->varchar();
                $table->field('time')->varchar();
                $table->field('assetid')->varchar();
                $table->field('usage_hr')->varchar();
                $table->field('activity')->varchar();
                $table->field('activity_status')->varchar();
                $table->field('asset_status')->varchar();
                $table->field('manager')->varchar();

            });
    }

    /**
     * Empty data in schema
     *
     * @return void
     */
    public static function empty()
    {
        DB::table(self::NAME)->truncate();
    }

    /**
     * Drop table
     *
     * @return void
     */
    public static function down()
    {
        DB::table(self::NAME)->drop();
    }
}