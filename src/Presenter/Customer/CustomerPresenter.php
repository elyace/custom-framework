<?php

namespace CFM\Presenter\Customer;

use CFM\Presenter\AbstractPresenter;

final class CustomerPresenter extends AbstractPresenter
{

    public function __construct(
        protected readonly int    $id,
        protected readonly string $firstName,
        protected readonly string $lastName,
        protected readonly string $email,
        protected readonly string $address,
    )
    {
    }

    public function present(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'address' => $this->address,
        ];
    }
}