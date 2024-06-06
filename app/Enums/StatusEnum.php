<?php

namespace App\Enums;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class StatusEnum implements CastsAttributes
{
    const ACTIVE = 1;
    const INACTIVE = 0;

    public function get($model, $key, $value, $attributes)
    {
        return $this->getValues()[$value];
    }

    public function set($model, $key, $value, $attributes)
    {
        return array_search($value, $this->getValues());
    }

    public function getValues(): array
    {
        return [
            self::ACTIVE => 'Ativo',
            self::INACTIVE => 'Inativo'
        ];
    }
}