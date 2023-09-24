<?php
namespace App\Services;

use App\Contracts\NotificationService;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class EmailApi implements NotificationService
{

    public function notify(User $user, string $message): Collection
    {

    }
}
