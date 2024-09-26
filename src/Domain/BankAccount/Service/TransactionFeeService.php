<?php

declare(strict_types=1);

namespace TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Service;

use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\ValueObject\Money;

class TransactionFeeService
{
    private const FEE_PERCENTAGE = 0.005;

    public function applyFee(Money $money): Money
    {
        $fee = $money->getAmount() * self::FEE_PERCENTAGE;
        return new Money($money->getAmount() + $fee, $money->getCurrency());
    }
}
