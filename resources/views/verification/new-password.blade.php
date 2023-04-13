<x-layout>
    <div class="px-6 ">
        <h1 class="font-extrabold  text-xl uppercase text-center mt-10">reset password</h1>

        <form class="mt-10 space-y-6">

            <div>
                <label for="password" class="font-bold py-6 ">
                    Password
                </label>
                <input type="password" name="password" id="password" placeholder="Fill in password"
                       class="border-2 border-gray-300 p-4 rounded-lg w-full form-input "
                >
            </div>

            <div>
                <label for="password_confirmation" class="font-bold py-6">
                    Repeat Password
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat password"
                       class="border-2 border-gray-300 p-4 rounded-lg w-full form-input"
                >
            </div>
            <button type="submit" class="fixed bottom-20 left-6 right-6 bg-green-600 text-white p-3 mt-8 rounded-md hover:bg-blue-400 font-extrabold ">Save Changes</button>
        </form>
        </div>

</x-layout>
