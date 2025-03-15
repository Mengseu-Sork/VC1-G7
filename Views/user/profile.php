
<header class="flex-1 relative bg-white dark:bg-darker">
                <div class="flex items-center justify-between p-2 border-b dark:border-primary-darker">
                    <!-- Desktop Right buttons -->
                    <nav aria-label="Secondary" class="hidden space-x-2 md:flex md:items-center">
                        <!-- User avatar button -->
                      <div class="relative" x-data="{ open: false }">
                        <button
                            @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                            type="button"
                            aria-haspopup="true"
                            :aria-expanded="open ? 'true' : 'false'"
                            class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100"
                        >
                            <span class="sr-only">User menu</span>
                            <img class="w-10 h-10 rounded-full" src="../../../Assets/images/pic5.jpg" alt="Ahmed Kamel" />
                        </button>

                        <!-- User dropdown menu -->
                        <div
                            x-show="open"
                            x-ref="userMenu"
                            x-transition:enter="transition-all transform ease-out"
                            x-transition:enter-start="translate-y-1/2 opacity-0"
                            x-transition:enter-end="translate-y-0 opacity-100"
                            x-transition:leave="transition-all transform ease-in"
                            x-transition:leave-start="translate-y-0 opacity-100"
                            x-transition:leave-end="translate-y-1/2 opacity-0"
                            @click.away="open = false"
                            @keydown.escape="open = false"
                            class="absolute right-0 w-48 py-1 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none"
                            tabindex="-1"
                            role="menu"
                            aria-orientation="vertical"
                            aria-label="User menu"
                          >
                          <div class="px-4 py-2 text-sm text-gray-700 dark:text-light text-center flex flex-col items-center">
                              <img class="w-10 h-10 rounded-full" src="../../../../Assets/images/pic5.jpg" alt="User Profile" />
                              <p class="font-semibold mt-2">MENGSEU SORK</p>
                          </div>
                          <ul class="mt-2 ml-4 space-y-2">
                            <li class="flex items-center gap-3 p-1 text-gray-700 hover:text-blue-500 cursor-pointer">
                              <span class="text-blue-500">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c3.313 0 6-2.686 6-6S15.313 2 12 2 6 4.686 6 8s2.687 6 6 6zM12 14c-4.418 0-8 2.686-8 6v2h16v-2c0-3.314-3.582-6-8-6z"></path>
                                </svg>
                              </span>
                              <a class="block py-2 text-sm text-gray-700 transition-colors dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400 nav-link" href="/user/show?id=<?= $user['id'] ?>">Your Profile</a>
                            </li>
                            <li class="flex items-center gap-3 p-1 text-gray-700 hover:text-blue-500 cursor-pointer">
                              <span class="text-green-500">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4l4 4-1.414 1.414L14.586 5.414 16 4zM4 14v6h6l8-8-6-6-8 8z"></path>
                                </svg>
                              </span>
                              <a  class="block py-2 text-sm text-gray-700 transition-colors dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400" href="../user/edit.php">Edit Profile</a>
                            </li>
                            <li class="flex items-center gap-3 p-1 text-gray-700 hover:text-blue-500 cursor-pointer">
                              <span class="text-yellow-500">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m-8-8h16"></path>
                                </svg>
                              </span>
                              <a  class="block py-2 text-sm text-gray-700 transition-colors dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400" href="">Add new profile +</a>
                            </li>
                            <li class="flex items-center gap-3 p-1 text-gray-700 hover:text-blue-500 cursor-pointer">
                              <span class="text-red-500">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                              </span>
                              <a  class="block py-2 text-sm text-gray-700 transition-colors dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400" href="">Logout</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </nav>
                </div>
        </header>