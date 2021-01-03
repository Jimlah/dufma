<?php

namespace App\Migrations;

use App\Core\Interfaces\MigrationInterface;
use App\Core\Modules\DB;
use App\Core\Modules\Db\DBTableBuilder;

class ExpLog implements MigrationInterface
{
    private const NAME = 'explog';

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
                $table->field('category')->varchar();
                $table->field('name')->varchar();
                $table->field('description')->varchar();
                $table->field('amount')->varchar();
                $table->field('quantity')->varchar();
                $table->field('status')->varchar();
                $table->field('duration_start')->varchar();
                $table->field('duration_end')->varchar();
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