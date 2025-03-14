<?php
require_once '../layout/navbarPages/header_user.php';
require_once '../layout/navbarPages/nav_user.php';
require_once '../layout/navbarPages/footer_user.php';
?>
<div class="container mx-auto p-6">
<<<<<<< HEAD:Views/user/edit.php
  <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
    <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
      <div class="shadow-lg rounded-lg p-6 transition duration-300 border-2 dark:border-primary-darker" :style="{ backgroundColor: bgColor }">
        <form action="/user/update?id=<?= $user['id'] ?>" method="POST">
=======
<div class="grid grid-cols-1 md:grid-cols-1 gap-6">
  <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
    <div class="shadow-lg rounded-lg p-6 transition duration-300 border-2 dark:border-primary-darker" :style="{ backgroundColor: bgColor }">
        <form action="/user/update?user_id=<?= $user['user_id'] ?>" method="POST" >
>>>>>>> 4e9b5b4c2ef93442db3c7deb023a72f78626809c:Views/admin/edit.php
          <label for="profile" class="block text-sm font-medium font-semibold">Select image:</label>
          <input type="file" id="profile" accept="images/*" onchange="previewImage(event) " class="block w-full text-sm font-semibold border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
          <div class="mt-4">
            <img id="preview" class="hidden w-32 h-32 rounded-lg object-cover font-semibold border border-gray-300">
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-medium">FisrtName:</label>
            <input type="text" value="<?= $user['FisrtName'] ?>" name="FisrtName" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-medium">LastName:</label>
            <input type="text" value="<?= $user['LastName'] ?>" name="LastName" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-medium">Email:</label>
            <input type="email" value="<?= $user['email'] ?>" name="email" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-medium">Password:</label>
            <input type="password" value="<?= $user['password'] ?>" name="password" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
          </div>
          <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-600 transition">
              Update
            </button>
          </div>
        </form>
    </div>