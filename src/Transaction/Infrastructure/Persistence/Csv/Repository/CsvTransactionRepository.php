<?php


namespace Src\Transaction\Infrastructure\Persistence\Csv\Repository;

use Exception;
use Src\Transaction\Domain\Collection\TransactionCollection;
use Src\Transaction\Domain\Repository\TransactionRepository;
use Src\Transaction\Infrastructure\Persistence\Csv\Mapper\CsvTransactionMapper;

class CsvTransactionRepository implements TransactionRepository
{

    public function __construct(
        private CsvTransactionMapper $mapper
    ){}

    /**
     * @return TransactionCollection
     * @throws Exception
     */
    public function searchAll(): TransactionCollection
    {
        $transactions = $this->all();
        return new TransactionCollection(...$transactions);
    }

    /**
     * @return array
     * @throws Exception
     */
    private function all(): array
    {
        $data = $this->getCsvData();
        return $this->mapper->__invoke($data);
    }

    private function getCsvData(): string
    {
        $pathToFile = resource_path('data/transactions.csv');
        return file_get_contents($pathToFile);
    }

}
