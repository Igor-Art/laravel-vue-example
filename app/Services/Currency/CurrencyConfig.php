<?php

namespace App\Services\Currency;

final readonly class CurrencyConfig
{
    /**
     * @param string $default
     * @param int $factor
     * @param array $currencies
     */
    public function __construct(
        private string $default,
        private int $factor,
        private array $currencies,
    ) {}

    /**
     * @return string
     */
    public function getDefault(): string
    {
        return $this->default;
    }

    /**
     * @return int
     */
    public function getFactor(): int
    {
        return $this->factor;
    }

    /**
     * @param string $code
     * @return int|float
     * @throws CurrencyException
     */
    public function getRate(string $code): int|float
    {
        return $this->getCurrencyConfig($code, 'rate');
    }

    /**
     * @param string $code
     * @return string
     * @throws CurrencyException
     */
    public function getSign(string $code): string
    {
        return $this->getCurrencyConfig($code, 'sign');
    }

    /**
     * @param string $code
     * @return int
     * @throws CurrencyException
     */
    public function getDecimal(string $code): int
    {
        return $this->getCurrencyConfig($code, 'decimal');
    }

    /**
     * @param string $code
     * @param string $key
     * @return mixed
     * @throws CurrencyException
     */
    private function getCurrencyConfig(string $code, string $key): mixed
    {
        $config = $this->currencies[$code] ?? null;

        if (!$config) {
            throw new CurrencyException(sprintf('Currency "%s" not available.', $code));
        }

        return $config[$key] ?? throw new CurrencyException(sprintf('Config key "%s" is not defined.', $key));
    }
}
