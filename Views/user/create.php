<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <form action="/user/store" method="POST" class="space-y-4">
                    <div>
                        <label class="block mb-2 font-semibold font-medium">Select image:</label>
                        <input type="file" name="image" class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300 border-b dark:border-primary-darker">
                    </div>
                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label class="block mb-2 font-semibold font-medium">First Name:</label>
                            <input type="text" name="FirstName" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                        </div>
                        <div class="w-1/2">
                            <label class="block mb-2 font-semibold font-medium">Last Name:</label>
                            <input type="text" name="LastName" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold font-medium">Email:</label>
                        <input type="email" name="email" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold font-medium">Password:</label>
                        <input type="password" name="password" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                    </div>
                    <button type="submit" class="w-30 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-4 rounded-md transition duration-200">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
