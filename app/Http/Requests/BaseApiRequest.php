<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Merge data with route parameters
     *
     * @return array
     */
    public function validationData(): array
    {
        return array_merge($this->all(), $this->route()->parameters);
    }
}
