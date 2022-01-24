<?php


namespace Src\Transaction\Infrastructure\Persistence\Csv\Repository;


use Src\Transaction\Domain\Collection\TransactionCollection;
use Src\Transaction\Domain\Repository\TransactionRepository;

class CsvTransactionRepository implements TransactionRepository
{

    public function searchAll(): TransactionCollection
    {
        return new TransactionCollection();
    }
}
