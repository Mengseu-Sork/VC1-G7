<?php
require_once __DIR__ . '/../layout/customer/header_user.php';
require_once __DIR__ . '/../layout/customer/nav_user.php';
require_once __DIR__ . '/../layout/customer/footer_user.php';

?>
                <header class="flex-1 relative bg-white dark:bg-darker">
                <div class="flex items-center justify-between p-2 border-b dark:border-primary-darker">
                    <button
                        @click="isMobileMainMenuOpen = !isMobileMainMenuOpen"
                        class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring"
                    >
                        <span class="sr-only">Open main manu</span>
                        <span aria-hidden="true">
                        <svg
                            class="w-8 h-8"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        </span>
                    </button>
                    <a
                        href="#"
                        class="inline-block text-2xl font-bold tracking-wider uppercase text-primary-dark dark:text-light"
                    >
                    </a>

                    <button
                        @click="isMobileSubMenuOpen = !isMobileSubMenuOpen"
                        class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring"
                    >
                        <span class="sr-only">Open sub manu</span>
                        <span aria-hidden="true">
                        <svg
                            class="w-8 h-8"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                            />
                        </svg>
                        </span>
                    </button>

                    <!-- Desktop Right buttons -->
                    <nav aria-label="Secondary" class="hidden space-x-2 md:flex md:items-center">
                        <!-- Toggle dark theme button -->
                        <button aria-hidden="true" class="relative focus:outline-none" x-cloak @click="toggleTheme">
                        <div
                            class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-lighter"
                        ></div>
                        <div
                            class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-150 transform scale-110 rounded-full shadow-sm"
                            :class="{ 'translate-x-0 -translate-y-px  bg-white text-primary-dark': !isDark, 'translate-x-6 text-primary-100 bg-primary-darker': isDark }"
                        >
                            <svg
                            x-show="!isDark"
                            class="w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                            />
                            </svg>
                            <svg
                            x-show="isDark"
                            class="w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                            />
                            </svg>
                        </div>
                        </button>

                        <!-- Notification button -->
                        <button
                        @click="openNotificationsPanel"
                        class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker"
                        >
                        <span class="sr-only">Open Notification panel</span>
                        <svg
                            class="w-7 h-7"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                            />
                        </svg>
                        </button>

                        <!-- Search button -->
                        <button
                        @click="openSearchPanel"
                        class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker"
                        >
                        <span class="sr-only">Open search panel</span>
                        <svg
                            class="w-7 h-7"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>
                        </button>

                        <!-- Settings button -->
                        <button
                        @click="openSettingsPanel"
                        class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker"
                        >
                        <span class="sr-only">Open settings panel</span>
                        <svg
                            class="w-7 h-7"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                            />
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                        </svg>
                        </button>
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
                                <i class="fas fa-user"></i>
                              </span>
                              <a class="block py-2 text-sm text-gray-700 transition-colors dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400 nav-link" href="views/user/detail.php">Your Profile</a>
                            </li>
                            <li class="flex items-center gap-3 p-1 text-gray-700 hover:text-blue-500 cursor-pointer">
                              <span class="text-green-500">
                                <i class="fas fa-pencil-alt"></i>
                              </span>
                              <a  class="block py-2 text-sm text-gray-700 transition-colors dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400" href="../user/edit.php">Edit Profile</a>
                            </li>
                            <li class="flex items-center gap-3 p-1 text-gray-700 hover:text-blue-500 cursor-pointer">
                              <span class="text-yellow-500">
                                <i class="fas fa-user-plus"></i>
                              </span>
                              <a  class="block py-2 text-sm text-gray-700 transition-colors dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400" href="">Add new account</a>
                            </li>
                            <li class="flex items-center gap-3 p-1 text-gray-700 hover:text-blue-500 cursor-pointer">
                              <span class="text-red-500">
                                <i class="fas fa-sign-out-alt"></i>
                              </span>
                              <a  class="block py-2 text-sm text-gray-700 transition-colors dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400" href="">Logout</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </nav>
                </div>
        </header>
        <div class="mx-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
                    <div class="shadow-lg rounded-lg p-6 transition duration-300 border-2 dark:border-primary-darker" :style="{ backgroundColor: bgColor }">
                    <img src="../../Assets/images/pic5.jpg" alt="Profile Picture" class="w-40 h-40 rounded-full mx-auto mb-4">
                    <div class="mb-4">
                        <span class="block text-center text-gray-700 text-3xl dark:text-light font-medium">Mengseu Sork</span>
                    </div>
                    <div class="mb-4">
                        <span class="block px-20 text-center text-gray-700 text-l dark:text-light font-medium">Social media has drastically changed the way photographers present their work. Platforms like Instagram, Pinterest, and TikTok have made it easier to reach a global audience and connect with clients directly. However, it also raises questions about the value of photos, the pressure to conform to trends, and the impact on creativity.</span>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <a href="/" class="px-4 py-2 text-white bg-red-500 hover:bg-red-400 rounded-md transition duration-200">Back</a>
                        <a href="#" class="px-4 py-2 text-white bg-blue-500 hover:bg-red-400 rounded-md transition duration-200">Edit</a>
                    </div>
                </div>
                </div>
            </div>
        </div>