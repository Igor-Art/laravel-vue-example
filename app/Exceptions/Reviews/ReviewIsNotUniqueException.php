<?php

namespace App\Exceptions\Reviews;

use Exception;
use Throwable;

class ReviewIsNotUniqueException extends Exception
{
    public function __construct(int $userId, int $gameId, ?Throwable $previous = null)
    {
        $message = sprintf('User #%d has already reviewed game %d', $userId, $gameId);

        parent::__construct($message, previous: $previous);
    }
}
