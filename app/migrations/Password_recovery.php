<?php

namespace App\Migrations;

use App\Core\Interfaces\MigrationInterface;
use App\Core\Modules\DB;
use App\Core\Modules\Db\DBTableBuilder;

class Password_recovery implements MigrationInterface
{
    private const NAME = 'password_recovery';

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
                $table->field('email')->varchar();
                $table->field('recovery_token')->varchar();
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