<?php
require_once '../layout/header.php';
require_once '../layout/nav.php';
require_once '../Dashboard/navList.php';
require_once '../layout/footer.php';
?>

<div class="container mx-auto mt-6 px-4">
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-800 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-center">Profile</th>
                    <th class="py-3 px-6 text-left">First Name</th>
                    <th class="py-3 px-6 text-left">Last Name</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Password</th>
                    <th class="py-3 px-6 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($users as $index => $user): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6"><?= $index + 1 ?></td>
                        <td class="py-3 px-6 text-center">
                            <img class="w-12 h-12 rounded-full border-2 border-gray-300 mx-auto" 
                                 src="<?= $user['image'] ?: '../default-avatar.png' ?>" 
                                 alt="User Avatar">
                        </td>
                        <td class="py-3 px-6"><?= htmlspecialchars($user['FisrtName']) ?></td>
                        <td class="py-3 px-6"><?= htmlspecialchars($user['LastName']) ?></td>
                        <td class="py-3 px-6"><?= htmlspecialchars($user['email']) ?></td>
                        <td class="py-3 px-6"><?= htmlspecialchars($user['password']) ?></td>
                        <td class="py-3 px-6 text-center">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600 transition">
                                Edit
                            </button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 transition">
                                Delete
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
