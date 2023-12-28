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
                $requestResult = RequestResult::where('user_request_id', $userRequest->id)->count();
                if ($requestResult == 0) {
                    try {
                        $out = shell_exec("python3 ./app/Crawl/main.py $userRequest->src $userRequest->dst $userRequest->date");
                        $this->notificationService->notify($user, $out);
                        RequestResult::create([
                            'user_request_id' => $userRequest->id,
                            'result' => json_encode($out)
                        ]);
                        Log::debug(json_encode($out));
                    } catch (\Exception $e) {
                        Log::debug($e->getMessage());
                    }
                }
            }
        }
    }
}
