<?php

namespace App\Http\Controllers;

use App\Contracts\HashTransporter;

class ApiController extends Controller
{
    private HashTransporter $hashTransporter;

    /**
     * ApiController constructor.
     * @param HashTransporter $hashTransporter
     */
    public function __construct(HashTransporter $hashTransporter)
    {
        $this->hashTransporter = $hashTransporter;
    }

    public function fetch()
    {
        $hash = $this->hashTransporter->receive();
        return $hash;
    }
}
