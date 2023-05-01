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
<body class="flex justify-between">
<header class="flex-col flex">
    <div class="flex justify-between items-center p-6 lg:px-16 lg:w-form">
        <img src="{{asset('assets/logo.png')}}" alt="logo" class="lg:w-52 ">
    </div>

    <div class="w-form">

        {{$slot}}


    </div>

</header>
<div class="hidden lg:block xl:flex">
    <img src="{{asset('assets/background.svg')}}" alt="" class="lg:ml-auto">
</div>
</body>
</html>
