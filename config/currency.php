<?php

return [
    /*
     * Fallback currency code.
     */
    'default' => 'USD',

    /*
     * Factor to calculate the fractional value.
     */
    'factor' => 100,

    /*
     * Available currencies
     */
    'uses' => [
        'USD' => [
            /*
             * Displayed currency sign.
             */
            'sign' => ' $',

            /*
             * Exchange rate for conversion.
             */
            'rate' => 1,

            /*
             * Displayed number of fractional part.
             */
            'decimal' => 2,
        ],
    ],
];
