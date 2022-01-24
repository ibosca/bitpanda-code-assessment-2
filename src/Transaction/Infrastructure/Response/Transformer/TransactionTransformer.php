<?php


namespace Src\Transaction\Infrastructure\Response\Transformer;



use Src\Transaction\Domain\Aggregate\Transaction;

class TransactionTransformer
{

    public function __invoke(Transaction ...$transactions): array
    {
        return array_map(
            fn(Transaction $transaction): array => $this->transform($transaction),
            $transactions
        );
    }


    private function transform(Transaction $transaction): array {
        return [
            'id' => $transaction->id()->value(),
            'code' => $transaction->code()->value(),
            'amount' => $transaction->amount()->value(),
            'source' => $transaction->source()->value(),
            'userId' => $transaction->userId()->value(),
            'createdAt' => $transaction->createdAt()->__toString(),
            'updatedAt' => $transaction->updatedAt()->__toString()
        ];
    }

}
