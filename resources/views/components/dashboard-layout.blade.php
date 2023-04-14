<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coronatime</title>

    @vite('resources/css/app.css')
    <script  src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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

        <div x-data="{ show: false }" >

         <button @click="show = !show" class="block lg:hidden">
            <img src="/storage/menu-icon.png" alt="" class="cursor-pointer">
         </button>

            <div x-show="show" >
                @if (auth()->check())
{{--                    <div class="bg-gray-300">--}}

                    <p class="fixed right-5  bg-gray-300 py-2 mt-1 px-16 rounded uppercase font-bold text-center" >{{ auth()->user()->name }}</p>
                    <form action="{{ route('logout') }}" method="POST" class="fixed right-1 py-2  px-16 mt-10 rounded font-bold">
                        @csrf
                        <button type="submit" class="uppercase text-center">Logout</button>
                    </form>

{{--                    </div>--}}
                @else
                    <a href="{{route('login')}}" class="fixed right-5 py-2 bg-gray-300 px-16 mt-4 rounded uppercase font-bold">Log in</a>
                @endif
            </div>
        </div>
    </div>

{{--    <div class="border border-gray-100 w-full block"></div>--}}
</header>
{{$slot}}
</body>
</html>
