<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Country\CountryRequest;
use App\Http\Requests\Api\Country\CountryStoreRequest;
use App\Http\Requests\Api\Country\CountryUpdateRequest;
use App\Services\Country\CountryService;
use Illuminate\Http\JsonResponse;

class CountryController extends ApiController
{
    private CountryService $countryService;

    public function __construct()
    {
        $this->countryService = new CountryService();
    }

    /**
     * Countries list
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return $this->successResponse($this->countryService->get());
    }

    /**
     * Add new country
     *
     * @param CountryStoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(CountryStoreRequest $request): JsonResponse
    {
        if (!$this->countryService->create($request->all())) {
            $this->failedResponse(__('country.store.failed'), 409);
        }

        return $this->successResponse(__('country.store.success'), 201);
    }

    /**
     * Update country
     *
     * @param CountryUpdateRequest $request
     *
     * @return JsonResponse
     */
    public function update(CountryUpdateRequest $request): JsonResponse
    {
        if (!$this->countryService->update($request->id, $request->all())) {
            $this->failedResponse(__('country.update.failed'));
        }

        return $this->successResponse(__('country.update.success'));
    }

    /**
     * Delete country
     *
     * @param CountryRequest $request
     *
     * @return JsonResponse
     */
    public function destroy(CountryRequest $request): JsonResponse
    {
        if (!$this->countryService->delete($request->id)) {
            $this->failedResponse(__('country.delete.failed'));
        }

        return $this->successResponse(__('country.delete.success'));
    }
}
