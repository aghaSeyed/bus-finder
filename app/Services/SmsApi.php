<?php

namespace App\Services;

use App\Contracts\NotificationService;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Melipayamak\MelipayamakApi;

class SmsApi implements NotificationService
{

    public function notify(User $user, string $message): bool
    {
        try {
            $username = env('MELI_USER');
            $password = env('MELI_PASS');
            $api = new MelipayamakApi($username, $password);
            $sms = $api->sms();
            $to = $user->phone;
            $from = env('MELI_FROM');
            $response = $sms->send($to, $from, $message);
            $json = json_decode($response);
            Log::debug($json->Value);
            return true;
        } catch (\Exception $e) {
            Log::alert($e->getMessage());
            return false;
        }
    }
}
