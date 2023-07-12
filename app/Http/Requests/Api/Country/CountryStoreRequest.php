<?php

namespace App\Http\Requests\Api\Country;

use App\Http\Requests\Api\BaseRequest;

/**
 * @property int $user_id
 * @property string $name
 * @property string $iso
 */
class CountryStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|int|exists:users,id',
            'name' => 'required|string|min:3',
            'iso' => 'required|string|min:2|max:3',
        ];
    }
}
