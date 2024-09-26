<?php

declare(strict_types=1);

namespace TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Service;

use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Aggregate\BankAccount;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\ValueObject\Money;

interface BankingPolicyInterface
{
    public function canDebit(BankAccount $account, Money $amount): bool;
}
