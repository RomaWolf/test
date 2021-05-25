<?php

namespace App\Repositories;

use App\Models\Result;

class ResultRepository
{
    /**
     * @param array $attributes
     *
     * @return Result
     */
    public function create(array $attributes)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return Result::query()->create($attributes);
    }

    /**
     * @param int $a
     * @param int $b
     * @param int $c
     *
     * @return Result|null
     */
    public function find(int $a, int $b, int $c)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return Result::query()
            ->where('a', '=', $a)
            ->where('b', '=', $b)
            ->where('c', '=', $c)
            ->first();
    }
}
