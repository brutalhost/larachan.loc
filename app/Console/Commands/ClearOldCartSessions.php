<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ClearOldCartSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:clear-cart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear old cart sessions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newTime = strtotime('-14 days');
        $lifetime = date('U', $newTime);

        $sessions = DB::table('sessions')
            ->where('last_activity', '<', $lifetime)
            ->get();

        foreach ($sessions as $session) {
            $payload = unserialize(base64_decode($session->payload));
            if (isset($payload['cart'])) {
                unset($payload['cart']);
            }
            $sessionData = base64_encode(serialize($payload));
            $this->info('Deleting old cart session: '.$session->id);
            DB::table('sessions')
                ->where('id', $session->id)
                ->update(['payload' => $sessionData]);
        }

        $this->info('Old cart sessions cleared successfully.');
    }
}
