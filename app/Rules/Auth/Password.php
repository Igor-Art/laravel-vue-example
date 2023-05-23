<?php

namespace App\Rules\Auth;

class Password extends \Laravel\Fortify\Rules\Password
{
    protected $length = 6;
}
