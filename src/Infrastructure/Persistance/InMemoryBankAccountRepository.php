<?php

namespace TeamConnect\JakubSkowron\BankApp\Infrastructure\Persistance;

use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Aggregate\BankAccount;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Repository\BankAccountRepositoryInterface;

class InMemoryBankAccountRepository implements BankAccountRepositoryInterface
{
    private array $accounts = [];

    public function save(BankAccount $account): void
    {
        $this->accounts[(string)$account->getId()] = $account;
    }

    public function findById(string $accountId): ?BankAccount
    {
        return $this->accounts[$accountId] ?? null;
    }
}