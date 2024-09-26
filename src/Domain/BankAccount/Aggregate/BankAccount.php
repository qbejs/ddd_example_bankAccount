<?php

declare(strict_types=1);

namespace TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Aggregate;

use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Entity\BankAccountId;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Service\BankingPolicyInterface;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Service\TransactionFeeService;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\ValueObject\Money;

class BankAccount
{
    private BankAccountId $id;
    private Money $balance;
    private int $dailyTransactionsCount;

    public function __construct(BankAccountId $id, Money $balance)
    {
        $this->id = $id;
        $this->balance = $balance;
        $this->dailyTransactionsCount = 0;
    }

    public function credit(Money $money): void
    {
        $this->balance = $this->balance->add($money);
    }

    public function debit(Money $money, TransactionFeeService $feeService, BankingPolicyInterface $policy): void
    {
        if (!$policy->canDebit($this, $money)) {
            throw new \RuntimeException('Debit not allowed.');
        }

        $totalAmount = $feeService->applyFee($money);
        $this->balance = $this->balance->subtract($totalAmount);
        $this->dailyTransactionsCount++;
    }

    public function getBalance(): Money
    {
        return $this->balance;
    }

    public function getId(): BankAccountId
    {
        return $this->id;
    }

    public function getDailyTransactionsCount(): int
    {
        return $this->dailyTransactionsCount;
    }
}
