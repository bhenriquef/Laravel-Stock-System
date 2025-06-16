<?php

namespace App\DTOs;

class SupplierDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $city,
        public readonly string $state,
        public readonly string $street,
        public readonly string $neighborhood,
        public readonly string $number,
        public readonly string $cep,
        public readonly string $country,
    )
    {
        //
    }

    public static function fromArray(array $data): self {
        return new self(
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'],
            city: $data['city'],
            state: $data['state'],
            street: $data['street'],
            neighborhood: $data['neighborhood'],
            number: $data['number'],
            cep: $data['cep'],
            country: $data['country'],
        );
    }

    public static function toArray(SupplierDTO $data) : array{
        $return = [
            "name" => $data->name,
            "email" => $data->email,
            "phone" => $data->phone,
            "city" => $data->city,
            "state" => $data->state,
            "street" => $data->street,
            "neighborhood" => $data->neighborhood,
            "number" => $data->number,
            "cep" => $data->cep,
            "country" => $data->country,
        ];

        array_filter($return, fn($v) => !is_null($v));

        return $return;
    }
}
