<?php

namespace App\Services\Country\Repositories;

use App\Models\Country;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CountryRepository
{
    private const CACHE_KEY = 'countries';

    /**
     * Get all countries
     *
     * @return Country[]|Collection
     */
    public function get()
    {
        $countries = Cache::get(self::CACHE_KEY);
        if (empty($countries)) {
            $countries = $this->cache();
        }

        return $countries;
    }

    /**
     * Add country
     *
     * @param array $data
     *
     * @return Country
     */
    public function create(array $data): Country
    {
        $country = Country::firstOrCreate($data);
        $this->cache();

        return $country;
    }

    /**
     * Delete country
     *
     * @param int $id
     *
     * @return int
     */
    public function delete(int $id): int
    {
        $result = Country::destroy($id);
        $this->cache();

        return $result;
    }

    /**
     * Update country
     *
     * @param int $id
     * @param array $data
     *
     * @return Country
     */
    public function update(int $id, array $data): Country
    {
        $country = Country::findOrFail($id);
        $country->update($data);
        $this->cache();

        return $country;
    }

    /**
     * Cache all countries
     *
     * @return Country[]|Collection
     */
    public function cache()
    {
        $countries = Country::all();
        Cache::put(self::CACHE_KEY, $countries, env('CACHE_TTL'));

        return $countries;
    }
}
