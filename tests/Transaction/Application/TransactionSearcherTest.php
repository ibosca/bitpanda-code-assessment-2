<?php

namespace Tests\Transaction\Application;

use PHPUnit\Framework\TestCase;
use Src\Transaction\Application\TransactionSearcher;
use Src\Transaction\Domain\Collection\TransactionCollection;
use Src\Transaction\Domain\Repository\TransactionRepository;
use Src\Transaction\Domain\Service\TransactionRepositoryBySourceFactory;
use Src\Transaction\Domain\ValueObject\TransactionSource;

class TransactionSearcherTest extends TestCase
{
    public function test_search_for_transactions()
    {

        $source = new TransactionSource('db');

        $repository = $this->createMock(TransactionRepository::class);
        $repository
            ->expects($this->once())
            ->method('searchAll')
            ->will($this->returnValue(new TransactionCollection()));

        $factory = $this->createMock(TransactionRepositoryBySourceFactory::class);
        $factory
            ->expects($this->once())
            ->method('__invoke')
            ->with($this->equalTo($source))
            ->will($this->returnValue($repository));

        $sut = new TransactionSearcher($factory);

        $sut->__invoke($source);
    }
}
