<?php

declare(strict_types=1);

namespace TeamConnect\JakubSkowron\BankApp\Application\UseCase;

use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Repository\BankAccountRepositoryInterface;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Service\BankingPolicyInterface;
use TeamConnect\JakubSkowron\BankApp\Domain\BankAccount\Service\TransactionFeeService;
use TeamConnect\JakubSkowron\BankApp\Domain\Payment\Entity\Payment;

class ProcessPaymentUseCase
{
    private BankAccountRepositoryInterface $accountRepository;
    private TransactionFeeService $feeService;
    private BankingPolicyInterface $policy;

    public function __construct(
        BankAccountRepositoryInterface $accountRepository,
        TransactionFeeService $feeService,
        BankingPolicyInterface $policy
    ) {
        $this->accountRepository = $accountRepository;
        $this->feeService = $feeService;
        $this->policy = $policy;
    }

    public function execute(string $accountId, Payment $payment): void
    {
        $account = $this->accountRepository->findById($accountId);
        if (!$account) {
            throw new \RuntimeException('Account not found.');
        }

        $account->debit($payment->getMoney(), $this->feeService, $this->policy);
        $this->accountRepository->save($account);
    }
}
