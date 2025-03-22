
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <form action="/user/store" method="POST" class="space-y-4">
        <div>
            <label class="block text-gray-700 font-medium">Select image:</label>
            <input type="file" name="image" class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
        </div>
        <div class="flex gap-4">
            <div class="w-1/2">
                <label class="block text-gray-700 font-medium">First Name:</label>
                <input type="text" name="FirstName" class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
            </div>
            <div class="w-1/2">
                <label class="block text-gray-700 font-medium">Last Name:</label>
                <input type="text" name="LastName" class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
            </div>
        </div>
        <div>
            <label class="block text-gray-700 font-medium">Email:</label>
            <input type="email" name="email" class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
        </div>
        <div>
            <label class="block text-gray-700 font-medium">Password:</label>
            <input type="password" name="password_hash" class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
        </div>
        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">
            Submit
        </button>
    </form>
</div>
