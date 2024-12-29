<?php

declare(strict_types=1);

namespace App\Management\Domain\Exception;

use JetBrains\PhpStorm\Pure;

class MissingRequiredParameter extends \Exception
{
    #[Pure] public function __construct(string $field = "", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct(sprintf('Field %s is required', $field), $code, $previous);
    }
}
