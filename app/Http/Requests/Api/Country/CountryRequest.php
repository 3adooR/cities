<?php

namespace App\Http\Requests\Api\Country;

use App\Http\Requests\Api\BaseRequest;

/**
 * @property int $id
 */
class CountryRequest extends BaseRequest
{
    public bool $validateRouteId = true;

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:countries,id',
        ];
    }
}
