<?php

namespace App\Services;

use App\Contracts\NotificationService;
use App\Mail\UserService;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;

class EmailApi implements NotificationService
{

    public function notify(User $user, string $message): bool
    {
        Mail::to($user->email)->send(new UserService($message));
        return true;
    }
}
