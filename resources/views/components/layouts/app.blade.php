<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    @vite('resources/css/app.css')

    <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
    <title>jasonferenbach.com</title>
</head>
<body class="font-mono antialiased text-xs sm:text-base bg-slate-800">
    {{ $slot }}
</body>
</html>
