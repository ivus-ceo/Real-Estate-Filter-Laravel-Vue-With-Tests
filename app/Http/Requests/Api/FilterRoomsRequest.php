<?php

namespace App\Http\Requests\Api;

use App\Services\Filters\FilterService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterRoomsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'deal_type' => ['required', Rule::in(FilterService::DEAL_TYPES)],
        ];
    }
}
