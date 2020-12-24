<?php

namespace App\Migrations;

use App\Core\Interfaces\MigrationInterface;
use App\Core\Modules\DB;
use App\Core\Modules\Db\DBTableBuilder;

class Fpm implements MigrationInterface
{
    private const NAME = 'fpm';

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
                $table->field('assetid')->int();
                $table->field('soil_type')->varchar();
                $table->field('ph')->varchar();
                $table->field('active')->varchar();
                $table->field('cur_util')->varchar();
                $table->field('start_season')->varchar();
                $table->field('end_season')->varchar();
                $table->field('ownership')->varchar();
                $table->field('fallow_period')->varchar();
                $table->field('manager')->varchar();
                $table->field('capacity')->varchar();
                $table->field('type')->varchar();
                $table->field('purpose')->varchar();
                $table->field('status')->varchar();
                $table->field('fpm')->varchar();

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