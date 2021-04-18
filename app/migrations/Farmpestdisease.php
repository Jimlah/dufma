<?php

namespace App\Migrations;

use App\Core\Interfaces\MigrationInterface;
use App\Core\Modules\DB;
use App\Core\Modules\Db\DBTableBuilder;

class Farmpestdisease implements MigrationInterface
{
    private const NAME = 'farmpestdisease';

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
                $table->field('date_detected')->datetime();
                $table->field('time_detected')->datetime();
                $table->field('name')->varchar();
                $table->field('sci_name')->varchar();
                $table->field('description')->varchar();
                $table->field('symptoms')->varchar();
                $table->field('detected_by')->varchar();
                $table->field('steps')->varchar();
                $table->field('week1')->varchar();
                $table->field('week2')->varchar();
                $table->field('week3')->varchar();
                $table->field('remark')->varchar();
                $table->field('type')->varchar();
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