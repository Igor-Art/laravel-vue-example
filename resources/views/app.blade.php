<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/js/app.js'])
</head>
<body>
<div id="app"></div>
</body>
</html>
