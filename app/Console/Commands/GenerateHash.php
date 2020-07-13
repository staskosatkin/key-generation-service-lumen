<?php

namespace App\Console\Commands;

use App\Jobs\GenerateHashJob;
use App\Services\KeyManager;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class GenerateHash extends Command
{
    protected $signature = 'hash:generate';

    protected $description = 'Create new Random Hash';

    private KeyManager $keyManager;

    public function __construct(KeyManager $keyManager)
    {
        parent::__construct();
        $this->keyManager = $keyManager;
    }

    public function handle()
    {
        $amount = (int) $this->ask('Amount', 10);

        $iterations = (int) $this->ask('Iterations', 1);
        $multiplication = 1;
        if ($iterations > 1) {
            $multiplication = $this->ask('Multiplication', 1);
        }

        Collection::times($iterations, function ($index) use ($multiplication, $amount) {
            $totalAmount = $amount * (1 + $index * ($multiplication - 1)) ;
            dispatch(new GenerateHashJob($totalAmount));
        });

        $this->info('Process is queued');

    }
}
