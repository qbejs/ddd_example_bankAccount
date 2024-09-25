<?php

namespace TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Repository;

use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Aggregate\BankAccount;

interface BankAccountRepositoryInterface
{
    public function save(BankAccount $account): void;

    public function findById(string $accountId): ?BankAccount;
}