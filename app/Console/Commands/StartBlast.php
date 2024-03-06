<?php
namespace App\Console\Commands;

use App\Models\Campaign;
use App\Services\WhatsappService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
class StartBlast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = "start:blast";

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = "Command description";

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $wa;
    public function __construct(WhatsappService $wa)
    {
        parent::__construct();
        $this->wa = $wa;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        $waitingCampaigns = Campaign::where("schedule", "<=", now())
            ->whereIn("status", ["waiting", "processing"])
            ->with("phonebook", "device")
            ->get();

        foreach ($waitingCampaigns as $campaign) {
            $countPhonebook = $campaign->phonebook->contacts()->count();
            if ($countPhonebook == 0) {
                $campaign->update(["status" => "failed"]);
                continue;
            }

            if ($campaign->device->status != "Connected") {
                $campaign->update(["status" => "paused"]);
                continue;
            }

            $campaign->update(["status" => "processing"]);
            $pendingBlasts = $this->getPendingBlasts($campaign);
            if ($pendingBlasts->count() == 0) {
                continue;
            }

            // send progress
            $blastdata = [];
            foreach ($pendingBlasts as $blast) {
                $blastdata[] = [
                    "receiver" => $blast->receiver,
                    "message" => $this->random($blast->message), // function created to send random message
                ];
            }

            $data = [
                "data" => $blastdata,

                "delay" => rand(40, $campaign->delay), //in the rand function, the first is minimum time and the second is maximum time

                "campaign_id" => $campaign->id,

                "sender" => $campaign->device->body,
            ];

            try {
                $results = $this->wa->startBlast($data);

                $campaign->update(["status" => "processing"]);
            } catch (\Throwable $th) {
                $campaign->update(["status" => "failed"]);

                Log::error($th);
            }
        }

        return 0;
    }

    public function getPendingBlasts($campaign)
    {
        $pendingBlasts = $campaign

            ->blasts()

            ->where("status", "pending")

            ->limit(15)

            ->get();

        if ($pendingBlasts->count() == 0) {
            $campaign->update(["status" => "completed"]);

            return collect();
        }

        return $pendingBlasts;
    }

    // function created to send random message

    protected function random($str)
    {
        // Returns random values found between @ this | and @

        return preg_replace_callback(
            "/@(.*?)@/",
            function ($match) {
                // Splits 'this|and' strings into an array

                $words = explode("|", $match[1]);

                // Grabs a random array entry and returns it

                return $words[array_rand($words)];

                // The input string, which you provide when calling this func
            },
            $str
        );
    }
}
