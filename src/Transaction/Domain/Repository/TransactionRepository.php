<?php


namespace Src\Transaction\Domain\Repository;



use Src\Transaction\Domain\Collection\TransactionCollection;

interface TransactionRepository
{
    public function searchAll(): TransactionCollection;
}
