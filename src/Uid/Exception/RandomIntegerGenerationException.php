<?php

declare(strict_types=1);

namespace JordiMorillo\Uid\Exception;

use Exception;

class RandomIntegerGenerationException extends Exception
{
    public function __construct(string $message, int $code = 500)
    {
        parent::__construct($message, $code);
    }
}