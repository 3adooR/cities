<?php

namespace App\Services\Country\Handlers;

use App\Models\Country;
use App\Services\Country\Repositories\CountryRepository;

class CreateCountryHandler
{
    private CountryRepository $repository;

    public function __construct()
    {
        $this->repository = new CountryRepository();
    }

    public function handle(array $data): Country
    {
        return $this->repository->create($data);
    }
}
