<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coronatime</title>

    @vite('resources/css/app.css')
</head>
<body class="w-full">
<header class="flex-col flex">
    <div class="flex justify-between items-center p-6 lg:px-16">
        <img src="/public/assets/logo.png" alt="logo" class="lg:w-52 lg:flex   lg:mx-auto">

    </div>

    <div class="flex items-center justify-center ">

    {{$slot}}
    </div>
</header>

</body>
</html>
