<?php

namespace App\Services;

use App\Contracts\HashTransporter;
use Illuminate\Redis\RedisManager;

class RedisHashTransporter implements HashTransporter
{
    private const REDIS_KEY = 'hash-queue';

    private RedisManager $redisManager;

    public function __construct(RedisManager $redisManager)
    {
        $this->redisManager = $redisManager;
    }

    public function send(string $hash): void
    {
        $this->redisManager->client()->lPush(self::REDIS_KEY, $hash);
    }

    public function receive(): string
    {
        return $this->redisManager->client()->rPop(self::REDIS_KEY);
    }
}
