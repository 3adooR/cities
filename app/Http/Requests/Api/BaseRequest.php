<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

abstract class BaseRequest extends FormRequest
{
    /** @var bool */
    public bool $validateRouteId = false;

    /**
     * Add ID parameter from route to validation data
     *
     * @return array
     */
    public function validationData(): array
    {
        $data = $this->all();
        if ($this->validateRouteId) {
            $data = array_merge($data, ['id' => (int) $this->route('id')]);
        }

        return $data;
    }
}
