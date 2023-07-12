<?php

namespace App\Services\Country\Handlers;

use App\Services\Country\Repositories\CountryRepository;

class DeleteCountryHandler
{
    private CountryRepository $repository;

    public function __construct()
    {
        $this->repository = new CountryRepository();
    }

    public function handle($id): int
    {
        return $this->repository->delete($id);
    }
}
