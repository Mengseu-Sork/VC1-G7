<?php
require_once '../layout/header.php';
require_once '../layout/nav.php';
require_once '../layout/footer.php';
require_once '../Dashboard/navList.php';
require_once '../Dashboard/section.php';?>
<div x-data="{ bgColor: 'white' }" class="md:col-span-2 p-6">
            <div class=" shadow-lg rounded-lg p-6 transition duration-300 border-2 dark:border-primary-darker" :style="{ backgroundColor: bgColor }">
                <h3 class="text-2xl font-bold font-semibold mb-4">Edit Profile</h3>
                <form action="/admin/update?id=<?= $admin['id'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="space-y-2">
                        <label for="profile" class="block text-sm font-medium font-semibold">Select image:</label>
                        <input type="file" id="profile" accept="images/*" onchange="previewImage(event) "
                            class="block w-full text-sm font-semibold border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        <div class="mt-4">
                            <img id="preview" class="hidden w-32 h-32 rounded-lg object-cover font-semibold border border-gray-300">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="text-lg font-semibold">Username</label>
                        <input type="text" class="w-full border font-semibold rounded-lg p-2"  value="<?= $admin['username'] ?>" name="username" placeholder="Enter Username">
                    </div>

                    <div class="mt-4">
                        <label class="text-lg font-semibold">Email</label>
                        <input type="email" class="w-full border font-semibold rounded-lg p-2"  value="<?= $admin['email'] ?>" name="email" placeholder="Enter Email">
                    </div>

                    <div class="mt-4">
                        <label class="text-lg font-semibold">Password</label>
                        <input type="password" class="w-full border font-semibold rounded-lg p-2"  value="<?= $admin['password_hash'] ?>" name="password_hash" placeholder="Enter Password">
                    </div>
                    <div class="mt-6 text-center text-lg font-semibold">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>