
    <div class="container mx-auto mt-8 px-4">
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-6">
        <form action="/user/update?id=<?= $user['id'] ?>" method="POST" enctype="multipart/form-data">
            <div>
                <label class="block text-gray-700 font-medium">Select image:</label>
                <input type="file" name="image" class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
            </div>
            <div class="flex gap-4">
              <div class="mb-4">
                  <label class="block text-gray-700 font-semibold mb-2">FirstName:</label>
                  <input 
                      type="text" 
                      name="FirstName" 
                      value="<?= $user['FirstName'] ?>" 
                      class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  >
              </div>

              <div class="mb-4">
                  <label class="block text-gray-700 font-semibold mb-2">LastName:</label>
                  <input 
                      type="text" 
                      name="LastName" 
                      value="<?= $user['LastName'] ?>" 
                      class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  >
              </div>
            </div>

            <!-- Email Input -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Email:</label>
                <input 
                    type="email" 
                    name="email" 
                    value="<?= $user['email'] ?>" 
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Email:</label>
                <input 
                    type="password" 
                    name="password" 
                    value="<?= $user['password'] ?>" 
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>
            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md transition duration-200"
            >
                Update
            </button>
        </form>
    </div>
</div>

