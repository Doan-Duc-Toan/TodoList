<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo App template</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- @livewireStyles --}}
    <!-- Fonts -->

</head>

<body class="antialiased">
    <livewire:todo-list />
</body>
=
{{-- @livewireScripts --}}

</html>
