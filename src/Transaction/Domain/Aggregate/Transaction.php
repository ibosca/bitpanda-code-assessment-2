<?php


namespace Src\Transaction\Domain\Aggregate;



use Src\Shared\Domain\ValueObject\TransactionId;
use Src\Shared\Domain\ValueObject\UserId;
use Src\Transaction\Domain\ValueObject\TransactionAmount;
use Src\Transaction\Domain\ValueObject\TransactionCode;
use Src\Transaction\Domain\ValueObject\TransactionCreatedAt;
use Src\Transaction\Domain\ValueObject\TransactionUpdatedAt;

class Transaction
{

    private TransactionId $id;
    private TransactionCode $code;
    private TransactionAmount $amount;
    private UserId $userId;
    private TransactionCreatedAt $createdAt;
    private TransactionUpdatedAt $updatedAt;

    public function __construct(
        TransactionId $id,
        TransactionCode $code,
        TransactionAmount $amount,
        UserId $userId,
        TransactionCreatedAt $createdAt,
        TransactionUpdatedAt $updatedAt
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->amount = $amount;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function id(): TransactionId
    {
        return $this->id;
    }

    public function code(): TransactionCode
    {
        return $this->code;
    }

    public function amount(): TransactionAmount
    {
        return $this->amount;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function createdAt(): TransactionCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): TransactionUpdatedAt
    {
        return $this->updatedAt;
    }

}
