<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 mb-16 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h4 class="text-xl font-bold font-semibold mb-4">Add Category</h4>
                <form action="/categories/store" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                        <div class="flex flex-col">
                            <label for="categories_name" class="font-semibold mb-1">Category Name</label>
                            <input type="text" name="name" id="categories_name" required class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                            <span class="text-red-500 text-sm hidden" id="categories_name_error">Please enter a Category name</span>
                        </div>

                        <div class="flex flex-col">
                            <label for="description" class="font-semibold mb-2 block">Category Content</label>
                            <textarea name="description" id="description" rows="5"
                                    class="w-full border border-gray-300 rounded-lg font-semibold p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg" onclick="window.location.href='/products'">Cancel</button>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>