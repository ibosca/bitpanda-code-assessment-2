<?php

namespace Tests\Transaction\Domain\Service;

use Src\Transaction\Domain\Service\TransactionRepositoryBySourceFactory;
use PHPUnit\Framework\TestCase;
use Src\Transaction\Domain\ValueObject\TransactionSource;
use Src\Transaction\Infrastructure\Persistence\Csv\Repository\CsvTransactionRepository;
use Src\Transaction\Infrastructure\Persistence\Database\Repository\DatabaseTransactionRepository;

class TransactionRepositoryBySourceFactoryTest extends TestCase
{
    public function test_returns_database_repository()
    {

        $source = new TransactionSource('db');

        $dbRepository = $this->createMock(DatabaseTransactionRepository::class);
        $csvRepository = $this->createMock(CsvTransactionRepository::class);

        $sut = new TransactionRepositoryBySourceFactory($dbRepository, $csvRepository);

        $actual = $sut->__invoke($source);

        $this->assertInstanceOf(DatabaseTransactionRepository::class, $actual);
    }

    public function test_returns_csv_repository()
    {

        $source = new TransactionSource('csv');

        $dbRepository = $this->createMock(DatabaseTransactionRepository::class);
        $csvRepository = $this->createMock(CsvTransactionRepository::class);

        $sut = new TransactionRepositoryBySourceFactory($dbRepository, $csvRepository);

        $actual = $sut->__invoke($source);

        $this->assertInstanceOf(CsvTransactionRepository::class, $actual);
    }
}
