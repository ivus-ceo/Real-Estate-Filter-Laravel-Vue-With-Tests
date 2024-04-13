<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\SimpleDTO;

class BaseSimpleDTO extends SimpleDTO
{
    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}
