<?php


namespace Src\Transaction\Infrastructure\Persistence\Database\Repository;


use Src\Transaction\Domain\Collection\TransactionCollection;
use Src\Transaction\Domain\Repository\TransactionRepository;

class DatabaseTransactionRepository implements TransactionRepository
{

    public function searchAll(): TransactionCollection
    {
        return new TransactionCollection();
    }
}
