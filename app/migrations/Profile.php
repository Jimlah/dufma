<?php

namespace App\Migrations;

use App\Core\Interfaces\MigrationInterface;
use App\Core\Modules\DB;
use App\Core\Modules\Db\DBTableBuilder;

class Profile implements MigrationInterface
{
    private const NAME = 'profile';

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
                $table->field('firstname')->varchar();
                $table->field('lastname')->varchar();
                $table->field('companyname')->varchar();
                $table->field('email')->varchar();
                $table->field('image')->varchar();
                $table->field('address')->varchar();
                $table->field('gender')->varchar();
                $table->field('phone_no')->varchar();
                $table->field('next_of_kin')->varchar();
                $table->field('next_of_kin_no')->varchar();
                $table->field('department')->varchar();
                $table->field('salary')->varchar();
                $table->field('bkname')->varchar();
                $table->field('bkacct')->varchar();
                $table->field('contract_type')->varchar();
                $table->field('status')->varchar();

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