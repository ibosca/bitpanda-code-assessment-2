<?php


namespace Src\Transaction\Infrastructure\Persistence\Database\Repository;


use Exception;
use Illuminate\Support\Facades\DB;
use Src\Transaction\Domain\Aggregate\Transaction;
use Src\Transaction\Domain\Collection\TransactionCollection;
use Src\Transaction\Domain\Repository\TransactionRepository;
use Src\Transaction\Infrastructure\Persistence\Database\Mapper\TransactionMapper;
use stdClass;

class DatabaseTransactionRepository implements TransactionRepository
{

    public function __construct(
        private TransactionMapper $mapper
    ){}

    /**
     * @return TransactionCollection
     * @throws Exception
     */
    public function searchAll(): TransactionCollection
    {
        $result = DB::table('transactions')->get();

        $transactions = array_map(
            fn (stdClass $data): Transaction => $this->mapper->__invoke(get_object_vars($data)),
            $result->toArray()
        );

        return new TransactionCollection(...$transactions);
    }
}
