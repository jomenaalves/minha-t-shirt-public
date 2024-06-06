<?php

namespace App\Enums\Orders;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class OrderStatusEnum implements CastsAttributes
{
    const OPEN = 0;
    const WAITING = 1;
    const CLOSED = 2;
    const CANCELED = 3;
    const COMPLETED = 4;

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
            self::OPEN => 'Aberto',
            self::WAITING => 'Aguardando pagamento',
            self::CLOSED => 'Pago',
            self::CANCELED => 'Cancelado',
            self::COMPLETED => 'Concluído',
        ];
    }
}