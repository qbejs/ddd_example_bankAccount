<?php

namespace TeamConnect\JakubSkowron\BankApp\Tests;

use PHPUnit\Framework\TestCase;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Aggregate\BankAccount;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Entity\BankAccountId;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Service\BankingPolicy;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Service\TransactionFeeService;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\ValueObject\Currency;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\ValueObject\Money;

class BankAccountTest extends TestCase
{
    public function testCreditIncreasesBalance(): void
    {
        $account = new BankAccount(new BankAccountId('123'), new Money(0, new Currency('USD')));
        $account->credit(new Money(100, new Currency('USD')));
        $this->assertEquals(100, $account->getBalance()->getAmount());
    }

    public function testDebitDecreasesBalance(): void
    {
        $account = new BankAccount(new BankAccountId('123'), new Money(100, new Currency('USD')));
        $account->debit(new Money(50, new Currency('USD')), new TransactionFeeService(), new BankingPolicy());
        $this->assertEquals(49.75, $account->getBalance()->getAmount()); // 50 + 0.5% fee = 50.25
    }

    public function testCannotDebitWithInsufficientFunds(): void
    {
        $this->expectException(\RuntimeException::class);
        $account = new BankAccount(new BankAccountId('123'), new Money(10, new Currency('USD')));
        $account->debit(new Money(50, new Currency('USD')), new TransactionFeeService(), new BankingPolicy());
    }

    public function testCannotDebitMoreThanAllowedTransactionsPerDay(): void
    {
        $account = new BankAccount(new BankAccountId('123'), new Money(500, new Currency('USD')));
        $feeService = new TransactionFeeService();
        $policy = new BankingPolicy();

        for ($i = 0; $i < 3; $i++) {
            $account->debit(new Money(50, new Currency('USD')), $feeService, $policy);
        }

        $this->expectException(\RuntimeException::class);
        $account->debit(new Money(50, new Currency('USD')), $feeService, $policy);
    }
}