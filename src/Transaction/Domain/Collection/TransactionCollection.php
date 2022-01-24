<?php


namespace Src\Transaction\Domain\Collection;


use RuntimeException;
use Src\Shared\Domain\Collection\Collection;
use Src\Transaction\Domain\Aggregate\Transaction;

class TransactionCollection extends Collection
{
    public function __construct(Transaction ...$transactions)
    {
        parent::__construct(...$transactions);
    }

    protected function type(): string
    {
        return TransactionCollection::class;
    }

    public function values(): array
    {
        throw new RuntimeException('Not implemented!');
    }

    public static function fromValues(): TransactionCollection
    {
        throw new RuntimeException('Not implemented!');
    }
}
