<?php

declare(strict_types=1);

namespace TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\ValueObject;

use InvalidArgumentException;

class Money
{
    private float $amount;
    private Currency $currency;

    public function __construct(float $amount, Currency $currency)
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Amount cannot be negative.');
        }
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function add(Money $money): Money
    {
        $this->assertSameCurrency($money);
        return new Money($this->amount + $money->amount, $this->currency);
    }

    public function subtract(Money $money): Money
    {
        $this->assertSameCurrency($money);
        if ($this->amount < $money->amount) {
            throw new InvalidArgumentException('Insufficient funds.');
        }
        return new Money($this->amount - $money->amount, $this->currency);
    }

    public function greaterThan(Money $money): bool
    {
        $this->assertSameCurrency($money);
        return $this->amount > $money->amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    private function assertSameCurrency(Money $money): void
    {
        if (!$this->currency->equals($money->currency)) {
            throw new InvalidArgumentException('Currency mismatch.');
        }
    }
}
