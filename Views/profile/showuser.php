
<?php 
// foreach($users as $user):
?>
    <div class="mx-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
                    <div class="shadow-lg rounded-lg p-6 transition duration-300 border-2 dark:border-primary-darker" :style="{ backgroundColor: bgColor }">
                    <img src="../../Assets/images/user<?= $user['image']?>" alt="Profile Picture" class="w-40 h-40 rounded-full mx-auto mb-4">
                    <div class="mb-4">
                        <span class="block text-center text-gray-700 text-3xl dark:text-light font-medium"><?= $user["FirstName"]?> <?= $user["LastName"]?></span>
                    </div>
                    <div class="mb-4">
                        <span class="block px-20 text-center text-gray-700 text-l dark:text-light font-medium">Social media has drastically changed the way photographers present their work. Platforms like Instagram, Pinterest, and TikTok have made it easier to reach a global audience and connect with clients directly. However, it also raises questions about the value of photos, the pressure to conform to trends, and the impact on creativity.</span>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <a href="/" class="px-4 py-2 text-white bg-red-500 hover:bg-red-400 rounded-md transition duration-200">Back</a>
                        <a href="#" class="px-4 py-2 text-white bg-blue-500 hover:bg-red-400 rounded-md transition duration-200">Edit</a>
                    </div>
                    <?php 
                    // endforeach
                    ?>
                </div>
                </div>
            </div>
    </div>
