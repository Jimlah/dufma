<?php

namespace App\Migrations;

use App\Core\Interfaces\MigrationInterface;
use App\Core\Modules\DB;
use App\Core\Modules\Db\DBTableBuilder;

class Insurance implements MigrationInterface
{
    private const NAME = 'insurance';

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
                $table->field('insurance_parameter')->varchar();
                $table->field('quantity')->varchar();
                $table->field('content')->varchar();
                $table->field('start_date')->datetime();
                $table->field('end_date')->datetime();
                $table->field('expected_number_inspection')->varchar();
                $table->field('insurance_cost')->varchar();
                $table->field('insurance_terms')->varchar();
                $table->field('category')->varchar();
                $table->field('officer_name')->varchar();
                $table->field('company_name')->varchar();
                $table->field('purpose')->varchar();
                $table->field('total_cost')->varchar();
                $table->field('application_date')->varchar();
                $table->field('inspection_date')->varchar();
                $table->field('insurance_approval_date')->varchar();
                $table->field('insurance_state')->varchar();
                $table->field('insurance_branch')->varchar();
                $table->field('insurance_relationship_officer')->varchar();
                $table->field('duration')->varchar();
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