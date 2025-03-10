<?php
require_once '../layout/header.php';
require_once '../layout/nav.php';
require_once '../layout/footer.php';
require_once '../Dashboard/navList.php';
require_once '../Dashboard/section.php';?>
<div class="container mx-auto p-6">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 transition duration-300 border-2 dark:border-primary-darker" :style="{ backgroundColor: bgColor }">
                <?php if (!empty($admins)): ?>
                    <?php foreach ($admins as $admin): ?>
                    <div class="relative">
                        <img class="w-60 h-60 rounded-full border-4 border-white mx-auto mt-4" 
                            src="<?= htmlspecialchars($admin['profile']) ?>" alt="Admin Avatar">
                    </div>
                    <div class="text-center mt-4">
                        <h1 class="text-5xl font-bold"><?= htmlspecialchars($admin['username']) ?></h1>
                        <br>
                        <p class="text-3xl font-semibold"><?= htmlspecialchars($admin['email']) ?></p>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-red-500 text-xl font-semibold">No admins found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="md:col-span-2">
        <a href="/" class=" bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-blue-400 text-center w-20 ml-6">Back</a>
            <!-- Profile Edit Form -->
        <a href="editProfile.php" class=" bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-blue-400 text-center w-20 ml-6">Edit Profile</a>
    </div>
</div>
