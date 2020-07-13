<?php

namespace App\Console\Commands;

use App\Contracts\KeyManager;
use App\Jobs\CreateAvailableKeyJob;
use Illuminate\Console\Command;

class CreateHash extends Command
{
    protected $signature = 'hash:create';

    protected $description = 'Create new Available Hash';

    private KeyManager $keyManager;

    public function __construct(KeyManager $keyManager)
    {
        parent::__construct();
        $this->keyManager = $keyManager;
    }

    public function handle()
    {
        $hash = $this->ask('Enter Hash');

        dispatch(new CreateAvailableKeyJob($hash));
    }
}
