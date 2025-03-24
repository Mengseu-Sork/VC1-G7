<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 mb-16 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h2 class="text-left text-2xl font-bold mb-4">Edit User</h2>
                <form action="/user/update?id=<?= $user['id'] ?>" method="POST" enctype="multipart/form-data">
                    
                    <!-- Image Upload Section -->
                    <div>
                        <label class="block font-semibold mb-2">Select Image:</label>
                        <input type="file" name="image" id="imageInput"
                               class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300 mb-4">
                        
                        <!-- Image Preview -->
                        <img id="imagePreview" src="../../Assets/images/user/<?= $user["image"] ?>" 
                             alt="Profile Image" width="50" height="50"
                             class="rounded-lg border border-gray-300 shadow-md">
                    </div>

                    <div class="flex gap-4 mt-4">
                        <div class="w-1/2">
                            <label class="block font-semibold mb-2">First Name:</label>
                            <input type="text" name="FirstName" value="<?= $user['FirstName'] ?>"
                                   class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="w-1/2">
                            <label class="block font-semibold mb-2">Last Name:</label>
                            <input type="text" name="LastName" value="<?= $user['LastName'] ?>"
                                   class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block font-semibold mb-2">Email:</label>
                        <input type="email" name="email" value="<?= $user['email'] ?>"
                               class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mt-4">
                        <label class="block font-semibold mb-2">Password:</label>
                        <input type="password" name="password" value="<?= $user['password'] ?>"
                               class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit"
                                class="w-30 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
