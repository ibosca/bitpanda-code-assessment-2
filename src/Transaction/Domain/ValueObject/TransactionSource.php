<?php


namespace Src\Transaction\Domain\ValueObject;

use Src\Shared\Domain\Exception\BadRequestException;
use Src\Shared\Domain\ValueObject\StringValueObject;

class TransactionSource extends StringValueObject
{

    const TRANSACTION_SOURCE_DB = 'db';
    const TRANSACTION_SOURCE_CSV = 'csv';

    const AVAILABLE_TRANSACTION_SOURCES = [
      self::TRANSACTION_SOURCE_DB,
      self::TRANSACTION_SOURCE_CSV,
    ];

    /**
     * @param string $value
     * @throws BadRequestException
     */
    public function __construct(string $value)
    {
        $this->ensureIsValidSource($value);
        parent::__construct($value);
    }

    /**
     * @param string $value
     * @throws BadRequestException
     */
    private function ensureIsValidSource(string $value): void
    {
        if (!in_array($value, self::AVAILABLE_TRANSACTION_SOURCES)) {
            throw new BadRequestException(['source' => $value], 'Invalid source!');
        }
    }

    public static function database(): self
    {
        return new self(self::TRANSACTION_SOURCE_DB);
    }

}
