<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 mb-16 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h2 class="text-left text-2xl font-bold mb-4">Edit User</h2>
                <form action="/user/update?id=<?= $user['id'] ?>" method="POST" enctype="multipart/form-data">              
                <div class="flex flex-col">
                            <label class="font-semibold mb-1">User Image</label>
                            <div class="border border-gray-300 rounded-lg p-4 flex flex-col items-center justify-centerbg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                            <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImage(this)" class="mb-2 w-full border border-gray-300  dark:text-light dark:border-primary-darker">
                                <div class="w-24 h-24 flex items-center justify-center border border-gray-200 rounded-lg overflow-hidden mt-3">
                                    <img id="image-preview" src="<?php echo !empty($user['image']) ? '/Assets/images/uploads/' . $user['image'] : '#'; ?>" alt="Image Preview" class="object-cover w-full h-full <?php echo !empty($user['image']) ? '' : 'hidden'; ?>">
                                </div>
                                <p class="text-gray-500 text-sm mt-2">Drag and drop a file to upload</p>
                            </div>
                        </div>

                    <div class="flex gap-4 mt-4">
                        <div class="w-1/2">
                            <label class="block font-semibold mb-2">First Name:</label>
                            <input type="text" name="FirstName" value="<?= $user['FirstName'] ?>"
                                   class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                        </div>
                        <div class="w-1/2">
                            <label class="block font-semibold mb-2">Last Name:</label>
                            <input type="text" name="LastName" value="<?= $user['LastName'] ?>"
                                   class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block font-semibold mb-2">Email:</label>
                        <input type="email" name="email" value="<?= $user['email'] ?>"
                               class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mt-4">
                        <label class="block font-semibold mb-2">Phone:</label>
                        <input type="phone" name="phone" value="<?= $user['phone'] ?>"
                               class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
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
                        <button type="button" class="bg-yellow-500 text-white ml-2 px-4 py-2 rounded-lg hover:opacity-90" onclick="window.location.href='/user'">Cancel</button>
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
