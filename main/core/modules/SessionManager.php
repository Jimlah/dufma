<?php

namespace App\Core\Modules;

use App\Core\Modules\DB;

class SessionManager
{

    /**
     * Class constructor
     * 
     * Check if the session table has been created
     */
    public function __construct() {
        $this->up();
    }

    /**
     * On session close
     * 
     */
    public function close()
    {
        return true;
    }

    /**
     * On destroy session
     * 
     * @return void
     */
    public function destroy($session_id)
    {
        DB::table('sessions')
            ->delete()
            ->where('sess_id', $session_id)
            ->fulfil();
        return true;
    }

    /**
     * Session
     * 
     * @param string $maxlifetime
     * 
     * @return void
     */
    public function gc($maxlifetime)
    {
        $old = time() - $maxlifetime;

        DB::table('sessions')
            ->delete()
            ->where('UNIX_TIMESTAMP(last_update)', '<', $old)
            ->fulfil();

        return true;
    }

    /**
     * On session open
     * 
     * @param string $save_path
     * @param string $session_id Session Id
     * 
     * @return void
     */
    public function open($save_path, $session_name)
    {
        return true;
    }

    /**
     * On read session
     * 
     * @param string $session_id Session id
     */
    public function read($session_id)
    {
        $session = DB::table('sessions')
                ->select(['sess_data'])
                ->where('sess_id', $session_id)
                ->fetchOne();

        if(!$session) {
            return '';
        }

        return $session->sess_data;
    }

    /**
     * On write session data
     * 
     * @param string $session_id Session Id
     * @param string $session_data Data to write to session
     * 
     * @return void
     */
    public function write($session_id, $session_data)
    {

        $query = DB::table('sessions')
                    ->replace([
                        'sess_id' => $session_id,
                        'last_update' => date('Y-m-d H:i:s'),
                        'sess_data' => $session_data
                    ]);

        return true;
    }

    /**
     * Build session schema
     * 
     * For session handler
     */
    private function up()
    {
        DB::table('sessions')->create(function($table) {
            $table->field('sess_id')->varchar()->primary();
            $table->field('sess_data')->text();
            $table->field('last_update')->datetime();
        });
    }
}