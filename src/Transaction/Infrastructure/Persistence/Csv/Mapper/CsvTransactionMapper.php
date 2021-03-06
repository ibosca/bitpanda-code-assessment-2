<?php


namespace Src\Transaction\Infrastructure\Persistence\Csv\Mapper;


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

class CsvTransactionMapper
{

    /**
     * @param string $data
     * @return array
     * @throws Exception
     */
    public function __invoke(string $data): array
    {
        $lines = explode(PHP_EOL, $data);
        $lines = $this->removeHeader($lines);
        $lines = $this->removeEmptyLines($lines);

        return array_map(
            function(string $row): Transaction {
                $parts = explode(',', $row);
                return $this->buildTransaction($parts);
            },
            $lines
        );
    }

    /**
     * @param array $data
     * @return Transaction
     * @throws Exception
     */
    private function buildTransaction(array $data): Transaction
    {
        $id = (int) trim($data[0], '"');
        $code = trim($data[1], '"');
        $amount = (float) trim($data[2], '"');
        $userId = (int) trim($data[3], '"');
        $createdAt = DateTime::createFromFormat('Y-m-d H:i:s', trim($data[4], '"'));
        $updatedAt = DateTime::createFromFormat('Y-m-d H:i:s', trim($data[5], '"'));

        return new Transaction(
            new TransactionId($id),
            new TransactionCode($code),
            new TransactionAmount($amount),
            TransactionSource::csv(),
            new UserId($userId),
            new TransactionCreatedAt($createdAt),
            new TransactionUpdatedAt($updatedAt)
        );
    }

    private function removeHeader(array $data): array
    {
        array_shift($data);
        return $data;
    }

    private function removeEmptyLines(array $lines): array
    {
        return array_filter($lines, fn($value) => !is_null($value) && $value !== '');
    }

}
