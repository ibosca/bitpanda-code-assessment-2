<?php


namespace Src\Transaction\Domain\Service;


use RuntimeException;
use Src\Transaction\Domain\Repository\TransactionRepository;
use Src\Transaction\Domain\ValueObject\TransactionSource;
use Src\Transaction\Infrastructure\Persistence\Csv\Repository\CsvTransactionRepository;
use Src\Transaction\Infrastructure\Persistence\Database\Repository\DatabaseTransactionRepository;

class TransactionRepositoryBySourceFactory
{
    public function __construct(
        private DatabaseTransactionRepository $databaseTransactionRepository,
        private CsvTransactionRepository $csvTransactionRepository
    ){}

    public function __invoke(TransactionSource $source): TransactionRepository
    {

        return match ($source->value()) {
            TransactionSource::TRANSACTION_SOURCE_DB => $this->databaseTransactionRepository,
            TransactionSource::TRANSACTION_SOURCE_CSV => $this->csvTransactionRepository,
        };

    }

}
