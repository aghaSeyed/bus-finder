<?php

namespace App\Console\Commands;

use App\Contracts\NotificationService;
use App\Models\RequestResult;
use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CrawlCommand extends Command
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $service)
    {
        parent::__construct();
        $this->notificationService = $service;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crawl:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            /** @var User $user */
            $userRequests = UserRequest::where('user_id', $user->id)->get();
            foreach ($userRequests as $userRequest) {
                $requestResult = RequestResult::where('user_request_id', $userRequest->id)->get();
                if (empty($requestResult)) {
                    //        $out = shell_exec('python .\app\Crawl\main.py THR IFN 1402-06-29');

                }
            }
        }
        Log::debug(1);
    }
}
