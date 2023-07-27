<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Simple Blog</title>

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        @vite('resources/css/app.css')
</head>
<body class="bg-white text-black antialiased dark:bg-gray-900 dark:text-white ">
    <div id="app">
        
        <!-- <example-component></example-component> -->
    </div>
</div>
</body>
</html>
