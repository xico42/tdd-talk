<?php

declare(strict_types=1);

namespace Tests\Support\HttpClient;

use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\InvalidArgumentException;
use SebastianBergmann\Comparator\ComparisonFailure;

class ContainsRequest extends Constraint
{
    public function __construct(
        private RequestSpec $requestSpec
    ) {
    }

    public function evaluate($other, string $description = '', bool $returnResult = false): ?bool
    {
        if (!is_array($other)) {
            throw InvalidArgumentException::create($other, 'array');
        }

        $result = false;

        foreach ($other as $request) {
            if ($this->requestSpec->matches($request)) {
                $result = true;
                break;
            }
        }

        if ($returnResult) {
            return $result;
        }

        if (!$result) {
            $other = array_values(array_map(fn(RequestSpec $request) => $request->toArray(), $other));

            $patchedValue = array_fill(0, count($other), $this->requestSpec->toArray());

            $patchedValue = array_replace_recursive(
                $other,
                $patchedValue
            );

            $failure = new ComparisonFailure(
                $patchedValue,
                $other,
                var_export($patchedValue, true),
                var_export($other, true),
            );

            $this->fail($other, $description, $failure);
        }

        return null;
    }

    public function toString(): string
    {
        return 'contains the request ' . $this->exporter()->export($this->requestSpec->toArray());
    }

    protected function failureDescription($other): string
    {
        return 'request history ' . $this->toString();
    }
}
