<?php

namespace App\Http\Requests\Api\Country;

use App\Http\Requests\Api\BaseRequest;

/**
 * @property int $id
 * @property string $name
 * @property string $iso
 */
class CountryUpdateRequest extends BaseRequest
{
    public bool $validateRouteId = true;

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:countries,id',
            'name' => 'required|string|min:3',
            'iso' => 'required|string|min:2|max:3',
        ];
    }
}
