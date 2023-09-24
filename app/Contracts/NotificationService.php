<?php
namespace App\Contracts;


use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface NotificationService
{
    /**
     * Get tasks by user
     *
     * @param User $user
     * @param string $message
     */
    public function notify(User $user, string $message): Collection;

}
