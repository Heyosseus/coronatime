<x-verification-layout>
    <div class="px-6">
        <h1 class="font-extrabold  text-xl uppercase text-center mt-10">reset password</h1>
        <div class="mt-12">
            <form action="{{route('post_reset_password')}}" method="POST" class="lg:w-form">
                @csrf
                <label for="email" class="font-bold py-4">
                    Email
                </label>
                <input type="email" name="email" id="email" placeholder="Enter your email"
                       class="border-2 border-gray-300 p-4 rounded-lg w-full form-input mt-2 @error('email') border-red-500 @enderror"
                >
                @if(session('failed'))
                    <div class="flex space-x-1 mt-2">
                        <img src="/storage/invalid.png" alt="" width="20" height="10">
                        <p class="text-red-500 text-xs">@lang('register.reset_pass_email')</p>
                    </div>
                @endif
                <button type="submit"
                        class="fixed bottom-20 left-6 right-6 bg-green-600 text-white p-3 mt-8 rounded-md hover:bg-blue-400 font-extrabold
                        lg:w-form  lg:static lg:flex lg:items-center lg:justify-center ">
                    Sign Up
                </button>
            </form>

        </div>
    </div>


</x-verification-layout>
