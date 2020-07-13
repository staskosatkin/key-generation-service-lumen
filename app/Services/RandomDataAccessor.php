<?php

namespace App\Services;

use App\Contracts\BigReader;
use Illuminate\Database\Eloquent\Collection;

class RandomDataAccessor implements BigReader
{
    public function fetch(string $class, $size): Collection
    {
        $minId = $class::orderBy('id', 'asc')->offset(0)->limit(1)->first()->id;
        $maxId = $class::orderBy('id', 'desc')->offset(0)->limit(1)->first()->id;

        $records = $this->singleFetch($class, $minId, $maxId, $size);

        while ($records->count() < $size)
        {
            $left = $size - $records->count();
            $records->merge($this->singleFetch($class, $minId, $maxId, $left));
        }

        return $records;
    }

    private function singleFetch(string $class, int $minId, int $maxId, int $size): Collection
    {
        $randomIndex = random_int($minId, $maxId - 1 - $size);
        return $class::where('id', '>', $randomIndex)->where('id', '<=', $randomIndex + $size)
            ->orderBy('id', 'asc')->limit($size)->get();
    }
}
