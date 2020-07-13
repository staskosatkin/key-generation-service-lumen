<?php

namespace App\Jobs;

use App\Contracts\KeyManager;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateAvailableKeyJob extends Job
{
    use InteractsWithQueue, SerializesModels;

    private string $hash;

    /**
     * Create a new job instance.
     *
     * @param string $hash
     */
    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    /**
     * Execute the job.
     *
     * @param KeyManager $keyManager
     * @return void
     */
    public function handle(KeyManager $keyManager)
    {
        if ($keyManager->createHash($this->hash)) {
            Log::debug("Hash `{$this->hash}` wash created");
        } else {
            $this->fail();
        }
    }
}
