<?php


namespace Src\Transaction\Infrastructure\Persistence\Database\Mapper;


use DateTime;
use Exception;
use Src\Shared\Domain\ValueObject\TransactionId;
use Src\Shared\Domain\ValueObject\UserId;
use Src\Transaction\Domain\Aggregate\Transaction;
use Src\Transaction\Domain\ValueObject\TransactionAmount;
use Src\Transaction\Domain\ValueObject\TransactionCode;
use Src\Transaction\Domain\ValueObject\TransactionCreatedAt;
use Src\Transaction\Domain\ValueObject\TransactionSource;
use Src\Transaction\Domain\ValueObject\TransactionUpdatedAt;

class DatabaseTransactionMapper
{
    /**
     * @param array $data
     * @return Transaction
     * @throws Exception
     */
    public function __invoke(array $data): Transaction
    {
        return new Transaction(
            new TransactionId($data['id']),
            new TransactionCode($data['code']),
            new TransactionAmount($data['amount']),
            TransactionSource::database(),
            new UserId($data['user_id']),
            new TransactionCreatedAt(new DateTime($data['created_at'])),
            new TransactionUpdatedAt(new DateTime($data['updated_at']))
        );
    }

}
