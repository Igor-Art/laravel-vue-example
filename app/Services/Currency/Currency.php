<?php

namespace App\Services\Currency;

final readonly class Currency
{
    /**
     * Converted value to current currency
     *
     * @var float
     */
    public float $value;

    /**
     * Formatted converted value for display
     *
     * @var string
     */
    public string $formatted;

    /**
     * Currency sign
     *
     * @var string
     */
    public string $sign;

    /**
     * Current currency code
     *
     * @var string
     */
    public string $code;

    /**
     * @param int $original
     * @param CurrencyConfig $config
     * @param string|null $code
     * @throws CurrencyException
     */
    public function __construct(
        public int $original,
        private CurrencyConfig $config,
        ?string $code = null,
    ) {
        $this->code = $code ?? $this->config->getDefault();
        $this->sign = $this->config->getSign($this->code);
        $this->value = $this->convert($this->original);
        $this->formatted = $this->format($this->value);
    }

    /**
     * @param int $value
     * @param string|null $code
     * @return self
     */
    public static function make(int $value, ?string $code = null): self
    {
        return app(self::class, ['original' => $value, 'code' => $code]);
    }

    /**
     * @param int $value
     * @return float
     * @throws CurrencyException
     */
    private function convert(int $value): float
    {
        return $value * $this->config->getRate($this->code) / $this->config->getFactor();
    }

    /**
     * @param float $value
     * @return string
     * @throws CurrencyException
     */
    private function format(float $value): string
    {
        return number_format($value, $this->config->getDecimal($this->code));
    }
}
