<?php

namespace App\Console\Commands;

use App\Models\User;
use Bkwld\Croppa\Facades\Croppa;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RemoveUnusedAvatars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:remove-unused-avatars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unused avatars';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $counter = 0;
        $allFiles = Storage::files('public/avatars');

        $usedAvatars = User::pluck('avatar')->toArray();

        foreach ($allFiles as $file) {
            $fileName = basename($file);

            if (!in_array($fileName, $usedAvatars)) {
                Croppa::delete('/storage/avatars/' . $fileName);
                $this->line($fileName);
                $counter++;
            }
        }
        $this->info('Deleted '.$counter.' files.');
    }
}
