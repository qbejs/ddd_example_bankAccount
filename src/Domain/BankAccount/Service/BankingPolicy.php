<?php

namespace TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Service;

use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Aggregate\BankAccount;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\ValueObject\Money;

class BankingPolicy implements BankingPolicyInterface
{
    private const MAX_TRANSACTIONS_PER_DAY = 3;

    public function canDebit(BankAccount $account, Money $amount): bool
    {
        return $account->getBalance()->greaterThan($amount) && $account->getDailyTransactionsCount() < self::MAX_TRANSACTIONS_PER_DAY;
    }
}