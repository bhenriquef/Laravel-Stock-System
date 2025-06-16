<?php

namespace App\DTOs;

use Ramsey\Uuid\Type\Integer;

class PromotionDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly string $details,
        public readonly float $price,
        public readonly float $porcentage,
        public readonly int $client_id,
        public readonly int $product_id,
    )
    {
        //
    }

    public static function fromArray(array $data): self {
        return new self(
            name: $data['name'],
            details: $data['details'],
            price: $data['price'],
            porcentage: $data['porcentage'],
            client_id: $data['client_id'],
            product_id: $data['product_id'],
        );
    }

    public static function toArray(PromotionDTO $data) : array{
        $return = [
            'name' => $data->name,
            'details' => $data->details,
            'price' => $data->price,
            'porcentage' => $data->porcentage,
            'client_id' => $data->client_id,
            'product_id' => $data->product_id,
        ];

        array_filter($return, fn($v) => !is_null($v));

        return $return;
    }
}
