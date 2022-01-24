<?php


namespace Src\Transaction\Domain\Service;


use Src\Transaction\Domain\Repository\TransactionRepository;
use Src\Transaction\Domain\ValueObject\TransactionSource;

class TransactionRepositoryBySourceFactory
{

    public function __invoke(TransactionSource $source): TransactionRepository
    {
        // TODO: Implement __invoke() method.
    }

}
