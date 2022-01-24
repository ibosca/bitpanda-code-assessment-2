<?php


namespace Src\Transaction\Application;


use Src\Transaction\Domain\Collection\TransactionCollection;
use Src\Transaction\Domain\Service\TransactionRepositoryBySourceFactory;
use Src\Transaction\Domain\ValueObject\TransactionSource;

class TransactionSearcher
{
    public function __construct(
     private TransactionRepositoryBySourceFactory $factory
    ){}

    public function __invoke(TransactionSource $source): TransactionCollection
    {
        $transactionRepository = $this->factory->__invoke($source);
        return $transactionRepository->searchAll();
    }

}
