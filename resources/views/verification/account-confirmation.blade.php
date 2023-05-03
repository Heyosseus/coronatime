<x-verification-layout>
    <div class="flex flex-col items-center justify-center h-96" >
        <img src="{{asset('assets/checkmark.gif')}}" alt="" class="lg:w-16">
        <p class="text-center py-4 lg:text-lg" >Your account is confirmed<br class="lg:hidden">
            you can sign in</p>
        <a href="{{route('login')}}" class="fixed bottom-20 left-6 right-6 bg-green-600 text-white p-3 mt-8 rounded-md hover:bg-blue-400 font-extrabold
         lg:w-96  lg:static lg:flex lg:items-center lg:justify-center
        ">Sign In</a>
    </div>

</x-verification-layout>
