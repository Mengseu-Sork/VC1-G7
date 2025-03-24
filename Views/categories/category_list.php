
<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 mb-16 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h2 class="text-left ml-1 text-2xl font-bold mb-6">Category List</h2>
                <table class="min-w-full bg-white shadow-md rounded-lg border-collapse">
                    <thead>
                        <tr class="bg-blue-500 text-white uppercase text-xs sm:text-sm leading-normal">
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <tr class="duration-200 rounded-lg shadow-md transition bg-white border-b dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($category['category_id']); ?></td>
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($category['name']); ?></td>
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($category['description']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">No categories found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>