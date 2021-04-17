<?php

namespace App\Migrations;

use App\Core\Interfaces\MigrationInterface;
use App\Core\Modules\DB;
use App\Core\Modules\Db\DBTableBuilder;

class Pestdisease implements MigrationInterface
{
    private const NAME = 'pestdisease';

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
                $table->field('name')->varchar();
                $table->field('sci_name')->varchar();
                $table->field('category')->varchar();
                $table->field('disease_type')->varchar();
                $table->field('symptoms')->varchar();
                $table->field('cause')->varchar();
                $table->field('causative_organism')->varchar();
                $table->field('host')->varchar();
                $table->field('life_cycle')->varchar();
                $table->field('treatment')->varchar();
                $table->field('type')->int();
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