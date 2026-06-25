<?php

namespace App\Actions;

class GetGwmariadbPayload
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function execute(string $action, string $siteName = '')
    {
        if($siteName == ''):
            $payload = [
                'action' => $action
            ];
        else:
            $payload = [
                'action' => $action,
                'nome' => $siteName
            ];
        endif;

        return $payload;
    }
}
