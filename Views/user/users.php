         
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
                                    <!-- <th class="py-3 px-6 text-left">Role</th> -->
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
                                        <!-- <td class="py-3 px-6 font-semibold "><?= $user['role'] ?></td> -->
                                        <td class="flex py-3 px-2 font-semibold justify-center relative">

                                                <!-- Edit Option -->
                                                <a href="/user/edit?id=<?= $user['id'] ?>" 
                                                    class="block px-2 py-2 text-gray-700 flex items-center">
                                                        <i class="far fa-edit mr-1" style="color: green;"></i>
                                                </a>

                                                <!-- Delete Option -->
                                                <button onclick="openModal('deleteUserModal<?= $user['id'] ?>')" 
                                                        class="block text-left px-2 py-2 text-gray-700 flex items-center">
                                                            <i class="fas fa-trash-alt mr-1" style="color: red"></i>
                                                </button>

                                                <a href="/user/show?id=<?= $user['id'] ?>" 
                                                    class="block px-2 py-2 text-gray-700 flex items-center">
                                                    <i class="far fa-eye mr-1" style="color: blue;"></i>
                                                </a>
                                            </div>
                                        </td>
                                    <!-- Delete Confirmation Modal -->
                                    <div id="deleteUserModal<?= $user['id'] ?>" 
                                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                            <h2 class="text-lg font-semibold">Delete User</h2>
                                            <p class="mt-4">Are you sure you want to delete this user?</p>

                                            <div class="mt-6 flex justify-end space-x-2">
                                                <button onclick="closeModal('deleteUserModal<?= $user['id'] ?>')"
                                                    class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 transition duration-200">
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
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
