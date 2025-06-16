<?php

namespace App\DTOs;

class ProductMaterialDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly string $details,
        public readonly float $base_price
    )
    {
        //
    }

    public static function fromArray(array $data): self {
        return new self(
            name: $data['name'],
            details: $data['details'],
            base_price: $data['base_price'],
        );
    }

    public static function toArray(ProductMaterialDTO $data) : array{
        $return = [
            'name' => $data->name,
            'details' => $data->details,
            'base_price' => $data->base_price,
        ];

        array_filter($return, fn($v) => !is_null($v));

        return $return;
    }
}
