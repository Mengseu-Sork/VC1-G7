  
<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 mb-12 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                 <h2 class="text-left ml-1 text-2xl font-bold mb-6">User List</h2>
                <a href="/user/create" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                    Add User
                </a>
                    <div class="overflow-x-auto bg-white shadow-lg rounded-lg mt-5">
                        <table class="w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-blue-500 text-white uppercase text-xs sm:text-sm leading-normal">
                                    <th class="py-3 px-4 text-left">Profile</th>
                                    <th class="py-3 px-4 text-left">First Name</th>
                                    <th class="py-3 px-4 text-left">Last Name</th>
                                    <th class="py-3 px-6 text-left">Email</th>
                                    <th class="py-3 px-6 text-left">Phone</th>
                                    <th class="py-3 px-6 text-left">Role</th>
                                    <th class="py-3 px-6 text-left">Active</th>
                                    <th class="py-3 px-2 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                <?php foreach ($users as $index => $user): ?>
                                    <tr class="duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                        <td class="py-3 px-6 text-center">
                                            <img src="../Assets/images/uploads/<?= $user["image"]?>" alt=""  width="30" height="30" style="border-radius: 10px;"  >
                                        </td>
                                        <td class="py-3 px-4 font-semibold"><?= $user['FirstName'] ?></td>
                                        <td class="py-3 px-4 font-semibold"><?= $user['LastName'] ?></td>
                                        <td class="py-3 px-4 font-semibold"><?= $user['email'] ?></td>
                                        <td class="py-3 px-6 font-semibold"><?= $user['phone'] ?></td>
                                        <td class="py-3 px-6 font-semibold "><?= $user['role'] ?></td>
                                        <td class="py-3 px-6 font-semibold">
                                            <?php if ($user['active'] == 1): ?>
                                                <span class="text-green-500 font-semibold">Active</span>
                                            <?php else:?>
                                                <span class="text-red-500 font-semibold">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="flex py-3 px-2 font-semibold justify-center relative">

                                                <!-- Edit Option -->
                                                <button onclick="openModal('editUserModal<?= $user['id'] ?>')" 
                                                    class="block px-2 py-2 text-gray-700 flex items-center">
                                                    <i class="far fa-edit mr-1" style="color: green;"></i>
                                                </button>

                                                <!-- Delete Option -->
                                                <button onclick="openModal('deleteUserModal<?= $user['id'] ?>')" 
                                                        class="block text-left px-2 py-2 text-gray-700 flex items-center">
                                                            <i class="fas fa-trash-alt mr-1" style="color: red"></i>
                                                </button>


                                                <!-- Detail Option -->
                                                <button onclick="openModal('detailUserModal<?= $user['id'] ?>')" 
                                                        class="block text-left px-2 py-2 text-gray-700 flex items-center">
                                                            <i class="far fa-eye mr-1" style="color: blue;"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <!-- Delete Confirmation Modal -->
                                        <div id="deleteUserModal<?= $user['id'] ?>" 
                                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                                <h2 class="text-lg font-semibold flex justify-center">Delete User</h2>
                                                <p class="mt-4">Are you sure you want to delete this user?</p>

                                                <div class="mt-6 flex justify-end space-x-2">
                                                    <button onclick="closeModal('deleteUserModal<?= $user['id'] ?>')"
                                                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:opacity-90">
                                                        Cancel
                                                    </button>

                                                    <form action="/user/delete?id=<?= $user['id'] ?>" method="POST">
                                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Edit Confirmation Modal -->
                                        <div id="editUserModal<?= $user['id'] ?>" class="fixed inset-0 flex items-center justify-end hidden z-50 mt-16">
                                            <div class="max-auto flex-1 h-full ml-64 overflow-x-hidden overflow-y-auto bg-white dark:text-light dark:bg-darker">
                                                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                                                        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
                                                            <div class="shadow-lg rounded-lg p-6 border-2 mb-2 border-gray-200 dark:border-primary-darker transition duration-300"
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
                                                                            class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                                                    </div>

                                                                    <div class="mt-4">
                                                                        <label class="block font-semibold mb-2">Phone:</label>
                                                                        <input type="phone" name="phone" value="<?= $user['phone'] ?>"
                                                                            class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                                                    </div>

                                                                    <div class="mt-4">
                                                                        <label class="block font-semibold mb-2">Password:</label>
                                                                        <div class="relative">
                                                                            <input id="password" type="password" name="password" value="<?= htmlspecialchars($user['password']) ?>"
                                                                                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                                                            <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                                                                👁️
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    
                                                                    <div class="mt-4">
                                                                        <label class="block font-semibold mb-2">Role:</label>
                                                                        <input type="role" name="role" value="<?= $user['role'] ?>"
                                                                            class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
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
                                        </div>

                                        <!-- Detail Confirmation Modal -->
                                        <div id="detailUserModal<?= $user['id'] ?>" class="fixed inset-0 flex items-center justify-end hidden z-50 mt-16">
                                            <div class="max-auto flex-1 h-full ml-64 overflow-x-hidden overflow-y-auto bg-white dark:text-light dark:bg-darker">
                                                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                                                    <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
                                                        <div class="shadow-lg rounded-lg p-6 mb-2 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                                                            :style="{ backgroundColor: bgColor }">
                                                            <h3 class="text-xl font-semibold mb-4">User Details</h3>
                                                            <div class="flex gap-6">
                                                                <!-- Profile Image Section -->
                                                                <div class="flex flex-col items-center mt-2">
                                                                    <div class="relative">
                                                                        <img src="../Assets/images/uploads/<?= $user['image'] ?>" 
                                                                            alt="Profile Image" 
                                                                            class="w-64 h-80 border border-gray-300 shadow-md">
                                                                    </div>
                                                                </div>

                                                                <!-- Form Fields -->
                                                                <div class="flex-1">
                                                                    <div class="grid grid-cols-2 gap-4">
                                                                        <div>
                                                                            <label class="block font-semibold mb-3">First Name</label>
                                                                            <div class="w-72 border border-gray-300 p-2 rounded-md focus:ring-2 dark:border-primary-darker focus:ring-blue-500"><?= $user['FirstName']?></div>
                                                                                
                                                                        </div>
                                                                        <div>
                                                                            <label class="block font-semibold mb-3">Last Name</label>
                                                                            <div class="w-76 border border-gray-300 p-2 rounded-md focus:ring-2 dark:border-primary-darker focus:ring-blue-500"><?= $user['LastName']?></div>
                                                                                
                                                                        </div>
                                                                    </div>

                                                                    <div class="mt-4">
                                                                        <label class="block font-semibold mb-1">Email</label>
                                                                        <div class="flex items-center border border-gray-300 rounded-md dark:border-primary-darker">
                                                                            <span class="w-full p-2 focus:ring-2 focus:ring-blue-500 "><?= $user['email']?></span>
                                                                            <span class="px-2 text-green-600">✔</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mt-4">
                                                                        <label class="block font-semibold mb-1">Phone</label>
                                                                        <div class="flex items-center border border-gray-300 rounded-md dark:border-primary-darker">
                                                                            <span class="w-full p-2 focus:ring-2 focus:ring-blue-500 "><?= $user['phone']?></span>  
                                                                            <span class="px-2 text-green-600">✔</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-4">
                                                                        <label class="block font-semibold mb-1">Role</label>
                                                                        <div class="flex items-center border border-gray-300 rounded-md dark:border-primary-darker">
                                                                            <span class="w-full p-2 focus:ring-2 focus:ring-blue-500 "><?= $user['role']?></span>  
                                                                            <span class="px-2 text-green-600">✔</span>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="bg-yellow-500 text-white flex ml-auto mt-4 px-4 py-2 rounded-lg hover:opacity-90" onclick="window.location.href='/user'">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>

<script>
    function openModal(id) {
    document.getElementById(id).classList.remove("hidden");
    }

function closeModal(id) {
    document.getElementById(id).classList.add("hidden");
    }

    
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

    function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imgPreview = document.getElementById('image-preview');
            imgPreview.src = e.target.result;
            imgPreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
        }
    }

    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordField = document.getElementById('password');
        var currentType = passwordField.type;
        passwordField.type = currentType === 'password' ? 'text' : 'password';
    });
</script>