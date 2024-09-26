<?php

declare(strict_types=1);

namespace TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\ValueObject;

class Currency
{
    private string $code;

    public function __construct(string $code)
    {
        $this->code = strtoupper($code);
    }

    public function equals(Currency $currency): bool
    {
        return $this->code === $currency->code;
    }

    public function __toString(): string
    {
        return $this->code;
    }
}
