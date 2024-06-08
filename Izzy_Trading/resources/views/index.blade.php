<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Izzy_Trading assignment</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    @vite(['resources/js/app.js','resources/sass/app.scss'])

</head>
<body class="bg-dark position-relative min-vh-100">


<div id="app" class="d-flex justify-content-center">

    <cars_and_parts></cars_and_parts>


</div>


</body>
</html>

