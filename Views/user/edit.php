
<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <form action="/user/update?id=<?= $user['id'] ?>" method="POST" enctype="multipart/form-data">
                    <div>
                        <label class="block font-medium font-semibold mb-2">Select image:</label>
                        <input type="file" name="image" value="<?= $user['image'] ?>" class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300 mb-4 border-b dark:border-primary-darker">
                    </div>
                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label class="block  font-semibold mb-2">FirstName:</label>
                            <input 
                                type="text" 
                                name="FirstName" 
                                value="<?= $user['FirstName'] ?>" 
                                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker"
                            >
                        </div>

                        <div class="w-1/2">
                            <label class="block  font-semibold mb-2">LastName:</label>
                            <input 
                                type="text" 
                                name="LastName" 
                                value="<?= $user['LastName'] ?>" 
                                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker"
                            >
                        </div>
                    </div>

                    <!-- Email Input -->
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Email:</label>
                        <input 
                            type="email" 
                            name="email" 
                            value="<?= $user['email'] ?>" 
                            class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Email:</label>
                        <input 
                            type="password" 
                            name="password" 
                            value="<?= $user['password'] ?>" 
                            class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker"
                        >
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-30 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-4 rounded-md transition duration-200"
                    >
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

