<?php

namespace TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Entity;

class BankAccountId
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}