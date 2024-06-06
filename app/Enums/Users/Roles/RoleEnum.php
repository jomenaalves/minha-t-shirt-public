<?php 

namespace App\Enums\Users\Roles;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class RoleEnum implements CastsAttributes
{
    const ADMIN = 'admin';
    const USER = 'user';

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
            self::ADMIN => 'admin',
            self::USER => 'user'
        ];
    }
}