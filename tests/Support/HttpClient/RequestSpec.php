<?php

declare(strict_types=1);

namespace Tests\Support\HttpClient;

use Illuminate\Support\Arr;
use Psr\Http\Message\RequestInterface;

final class RequestSpec
{
    private ?string $method = null;
    private ?string $uri = null;
    private ?array $data = null;
    private ?array $headers = null;

    public static function aRequest(): self
    {
        return new self();
    }

    public static function fromRequest(RequestInterface $request, array $options): self
    {
        $spec = self::aRequest();
        $data = null;

        $query = trim($request->getUri()->getQuery());

        $request->getBody()->rewind();
        $body = trim($request->getBody()->getContents());

        if ('' !== $query) {
            $data = [];
            parse_str($query, $data);
        }

        if ('' !== $body) {
            $data ??= [];

            $data = array_merge(
                $data,
                json_decode($body, true, flags: JSON_THROW_ON_ERROR)
            );
        }

        if ($data !== null) {
            $spec = $spec->withData($data);
        }

        foreach ($request->getHeaders() as $header => $value) {
            $spec = $spec->withHeader($header, ...$value);
        }

        if (isset($options['base_uri'])) {
            $spec = $spec->withUri(
                str_replace(
                    (string) $options['base_uri'],
                    '',
                    (string) $request->getUri(),
                )
            );
        } else {
            $spec = $spec->withUri($request->getUri()->getPath());
        }

        return $spec
            ->withMethod($request->getMethod());
    }

    public function withMethod(string $method): self
    {
        $spec = clone $this;
        $spec->method = $method;
        return $spec;
    }

    public function withUri(string $uri): self
    {
        $spec = clone $this;
        $spec->uri = $uri;
        return $spec;
    }

    public function withData(array $data): self
    {
        $spec = clone $this;
        $spec->data = $data;
        return $spec;
    }

    public function withHeader(string $header, string ...$value): self
    {
        $spec = clone $this;

        if (is_null($spec->headers)) {
            $spec->headers = [];
        }

        $spec->headers[$header] = $value;

        return $spec;
    }

    public function toArray(): array
    {
        return array_filter([
            'method' => $this->method,
            'uri' => $this->uri,
            'data' => $this->data,
            'headers' => $this->headers,
        ], fn ($val) => !is_null($val));
    }

    public function matches(RequestSpec $target): bool
    {
        if (!is_null($this->uri) && $this->uri !== $target->uri) {
            return false;
        }

        if (!is_null($this->method) && strtolower($this->method) !== strtolower($target->method)) {
            return false;
        }

        if (!is_null($this->data) && is_null($target->data)) {
            return false;
        }

        if (!is_null($this->data) && Arr::sortRecursive($this->data) !== Arr::sortRecursive($target->data)) {
            return false;
        }

        if (!is_null($this->headers) && !$this->headerContains($target->headers, $this->headers)) {
            return false;
        }

        return true;
    }

    private function headerContains(array $targetHeader, array $headerSpec): bool
    {
        foreach ($headerSpec as $key => $value) {
            if (!isset($targetHeader[$key])) {
                return false;
            }

            if (Arr::sortRecursive($targetHeader[$key]) !== Arr::sortRecursive($value)) {
                return false;
            }
        }

        return true;
    }
}
