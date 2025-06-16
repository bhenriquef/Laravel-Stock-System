<?php

namespace App\DTOs;

class MaterialDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly string $details,
    )
    {
        //
    }

    public static function fromArray(array $data): self {
        return new self(
            name: $data['name'],
            details: $data['details'],
        );
    }

    public static function toArray(MaterialDTO $data) : array{
        $return = [
            'name' => $data->name,
            'details' => $data->details,
        ];

        array_filter($return, fn($v) => !is_null($v));

        return $return;
    }
}
