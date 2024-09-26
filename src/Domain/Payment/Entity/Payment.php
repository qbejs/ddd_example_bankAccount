<?php

declare(strict_types=1);

namespace TeamConnect\JakubSkowron\BankApp\Domain\Payment\Entity;

use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\ValueObject\Money;

class Payment
{
    private Money $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }
}
