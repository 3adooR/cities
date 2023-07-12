<?php

namespace App\Services\Country\Handlers;

use App\Models\Country;
use App\Services\Country\Repositories\CountryRepository;

class UpdateCountryHandler
{
    private CountryRepository $repository;

    public function __construct()
    {
        $this->repository = new CountryRepository();
    }

    public function handle(int $id, array $data): Country
    {
        return $this->repository->update($id, $data);
    }
}
