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
<body>
<header>
    <div class="flex justify-between items-center p-6">
        <img src="/storage/logo.png" alt="logo">
        <div>
            <select id="language-select" class="rounded-full bg-transparent text-black mx-2 border-0 outline-0">
                <option value="{{route('lang.switch', 'en')}}" class="bg-white">English</option>
                <option value="{{route('lang.switch', 'ka')}}" class="bg-white ">Georgian</option>
            </select>

        </div>
        <img src="/storage/menu-icon.png" alt="" class="cursor-pointer">

    </div>
    <div class="border border-gray-100 w-full block"></div>
</header>
{{$slot}}

</body>
</html>
