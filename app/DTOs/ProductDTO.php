<?php

namespace App\DTOs;

class ProductDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly string $details
    )
    {
        //
    }

    public static function fromArray(array $data): self {
        return new self(
            name: $data['name'],
            details: $data['details']
        );
    }

    public static function toArray(ProductDTO $data) : array{
        return [
            'name' => $data->name,
            'details' => $data->details,
        ];
    }
}
