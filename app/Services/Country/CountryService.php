<?php

namespace App\Services\Country;

use App\Models\Country;
use App\Services\Country\Handlers\CreateCountryHandler;
use App\Services\Country\Handlers\DeleteCountryHandler;
use App\Services\Country\Handlers\UpdateCountryHandler;
use App\Services\Country\Repositories\CountryRepository;
use Illuminate\Support\Collection;

class CountryService
{
    private CountryRepository $repository;
    private CreateCountryHandler $createHandler;
    private DeleteCountryHandler $deleteHandler;
    private UpdateCountryHandler $updateHandler;

    /**
     * ContractService constructor
     */
    public function __construct()
    {
        $this->repository = new CountryRepository();
        $this->createHandler = new CreateCountryHandler();
        $this->deleteHandler = new DeleteCountryHandler();
        $this->updateHandler = new UpdateCountryHandler();
    }

    /**
     * Get all countries
     *
     * @return Country[]|Collection
     */
    public function get()
    {
        return $this->repository->get();
    }

    /**
     * Add new country
     *
     * @param array $data
     *
     * @return Country
     */
    public function create(array $data): Country
    {
        return $this->createHandler->handle($data);
    }

    /**
     * Delete country by id
     *
     * @param int $id
     *
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->deleteHandler->handle($id);
    }

    /**
     * Update country by id
     *
     * @param int $id
     * @param array $data
     *
     * @return Country
     */
    public function update(int $id, array $data): Country
    {
        return $this->updateHandler->handle($id, $data);
    }
}
