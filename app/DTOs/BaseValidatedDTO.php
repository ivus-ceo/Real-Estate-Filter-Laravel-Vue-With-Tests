<?php

namespace App\DTOs;

use App\Models\Room;
use Illuminate\Support\{Collection, Number};
use Illuminate\Validation\{Rule, Validator, ValidationException};
use WendellAdriel\ValidatedDTO\Exceptions\{CastTargetException, MissingCastTypeException};
use App\DTOs\Components\Filters\Partials\{FilterDropdownComponentDTO, FilterRangeComponentDTO};
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class BaseValidatedDTO extends ValidatedDTO
{
    protected function rules(): array
    {
        return [];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }

    /**
     * @throws \Exception
     */
    protected function failedValidation(): void
    {
        throw new \Exception('There was a validation error in ' . get_class($this) . ': ' . $this->validator->getMessageBag()->toJson());
    }
}
