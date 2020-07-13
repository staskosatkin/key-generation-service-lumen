<?php

namespace App\Console\Commands;

use App\Services\KeyManager;
use Illuminate\Console\Command;

class DeliverHash extends Command
{
    protected $signature = 'hash:deliver';

    protected $description = 'Deliver stream of hashes';

    private KeyManager $keyManager;

    public function __construct(KeyManager $keyManager)
    {
        parent::__construct();
        $this->keyManager = $keyManager;
    }

    public function handle()
    {
        $amount = $this->ask('Amount', 100);

        $start = microtime(true);

        $keys = $this->keyManager->fetchHash($amount);

        $finish = microtime(true);
        $duration = $finish - $start;

        $speed = $amount / $duration;

        collect($keys)->each(fn ($hash) => $this->info($hash));

        $this->info('Process Finished');

        $this->table(['Amount', 'Duration', 'Speed'], [
            [$amount, $duration, $speed],
        ]);
    }
}
