<?php

namespace App\Migrations;

use App\Core\Interfaces\MigrationInterface;
use App\Core\Modules\DB;
use App\Core\Modules\Db\DBTableBuilder;

class CurrentAsset implements MigrationInterface
{
    private const NAME = 'currentasset';

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
                $table->field('category')->varchar();
                $table->field('name')->varchar();
                $table->field('description')->varchar();
                $table->field('amount')->int();
                $table->field('manufacturer')->varchar();
                $table->field('serial_no')->varchar();
                $table->field('size')->varchar();
                $table->field('location')->varchar();
                $table->field('longitude')->varchar();
                $table->field('latitude')->varchar();
                $table->field('quantity')->varchar();
                $table->field('del')->varchar();
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