<x-layout>
    <h1 class="font-bold px-6 text-2xl">Welcome Back</h1>
    <p class="text-sm px-6 mt-3">Welcome back! Please enter your details</p>

    <form action="{{route('post_login')}}" method="POST" class="flex flex-col px-6">
        @csrf
        <label for="username" class="font-bold py-2 mt-10">
            Username
        </label>
        <input type="text" name="username" id="username"  placeholder="Enter unique username"
               class="border-2 border-gray-300 p-4 rounded-lg w-full">

        <label for="password" class="font-bold py-2 mt-6">
            Password
        </label>
        <input type="password" name="password" id="password" placeholder="Fill in password"
               class="border-2 border-gray-300 p-4 rounded-lg w-full"
        >

        <div class="flex items-center justify-between mt-6">
        <div class="">
            <input type="checkbox" name="remember_device" id="remember_device">
            <label for="remember_device" class="font-bold text-sm">Remember this device</label>
        </div>
            <a href="#" class="text-sm text-blue-600 font-bold" >Forgot password?</a>
        </div>

        <button type="submit" class="bg-green-600 text-white p-3 mt-10 rounded hover:bg-blue-400 font-bold">Log in</button>

        <p class="text-center py-8">Don't have an account? <a href="{{route('register')}}" class="font-bold "> Sign up for free </a></p>
    </form>
</x-layout>
