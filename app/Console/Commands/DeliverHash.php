<?php

namespace App\Console\Commands;

use App\Jobs\DeliverHashJob;
use App\Services\KeyManager;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

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
        $iterations = $this->ask('Iterations', 1);

        // dispatch Job
        Collection::times($iterations, function () use ($amount) {
            dispatch(new DeliverHashJob($amount));
        });


        $this->info('Job queued');
    }
}
