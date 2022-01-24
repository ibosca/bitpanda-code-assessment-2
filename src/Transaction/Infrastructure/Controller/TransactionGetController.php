<?php

namespace Src\Transaction\Infrastructure\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Shared\Domain\Exception\BadRequestException;
use Src\Transaction\Application\TransactionSearcher;
use Src\Transaction\Domain\ValueObject\TransactionSource;
use Src\Transaction\Infrastructure\Response\Transformer\TransactionTransformer;

class TransactionGetController extends Controller
{


    public function __construct(
        private TransactionSearcher $searcher,
        private TransactionTransformer $transformer,
    ){}

    // http://localhost:8000/api/transactions?source=db

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws BadRequestException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validateRequest($request);

        $query = $request->query();
        $source = new TransactionSource($query['source']);

        $transactionCollection = $this->searcher->__invoke($source);

        return response()->json(
            $this->transformer->__invoke(...$transactionCollection->items())
        );

    }

    /**
     * @param Request $request
     * @throws BadRequestException
     */
    private function validateRequest(Request $request): void
    {
        $data = $request->query();
        $mandatoryFields = ["source"];

        foreach ($mandatoryFields as $mandatoryField) {
            if (!array_key_exists($mandatoryField, $data)) {
                throw new BadRequestException([], "Mandatory fiels {$mandatoryField} not provided.");
            }
        }
    }

}
