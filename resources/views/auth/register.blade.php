<x-layout>
    <h1 class="font-bold px-6 text-2xl">Welcome to Coronatime</h1>
    <p class="text-sm px-6 mt-3">Please enter required info to sign up</p>

    <form action="{{route('post_register')}}" method="POST" class="flex flex-col px-6 space-y-2">
        @csrf
        <label for="username" class="font-bold py-2">
            Username
        </label>
        <input type="text" name="username" id="username"  placeholder="Enter unique username"
               class="border-2 border-gray-200 p-4 rounded-lg w-full">

        <label for="email" class="font-bold py-2">
            Email
        </label>
        <input type="email" name="email" id="email" placeholder="Enter your email"
               class="border-2 border-gray-200 p-4 rounded-lg w-full"
        >

        <label for="password" class="font-bold py-2">
            Password
        </label>
        <input type="password" name="password" id="password" placeholder="Fill in password"
               class="border-2 border-gray-200 p-4 rounded-lg w-full"
        >
        <label for="password_confirmation" class="font-bold py-2">
            Repeat Password
        </label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat password"
               class="border-2 border-gray-200 p-4 rounded-lg w-full"
        >

        <div class="py-4">
            <input type="checkbox" name="remember_device" id="remember_device">
            <label for="remember_device">Remember this device</label>
        </div>

        <button type="submit" class="bg-green-600 text-white p-3 mt-6 rounded hover:bg-blue-400 font-bold">Sign Up</button>

        <p class="text-center py-4">Already have an account? <a href="#" class="font-bold underline"> Log in </a></p>
    </form>
</x-layout>
