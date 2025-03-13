<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>SAN CAFE</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../../Assets/css/tailwind.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <style>  
        body {  
            font-family: Arial, sans-serif;  
            background-color: #f8f8f8;  
            margin: 0;  
            padding: 20px;  
        }  

        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-box {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
   
h1 {
    text-align: left;
    padding-left: 20px; 
    font-size: 24px;
    font-weight: bold;
}


.container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px;
}

.product {
    width: 200px;
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
    border-radius: 8px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}
.product img {
    width: 80px; /* Adjust image size */
    height: auto;
    border-radius: 5px;
    margin-right: 15px; /* Space between image and text */
}

.product-info {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Align text to the left */
}

.product-name {
    font-size: 18px;
    font-weight: bold;
}



.search-container {
    text-align: left;
    padding: 20px;
}
        .container {  
            display: flex;  
            flex-wrap: wrap;  
            justify-content: space-between;  
            max-width: 1200px;  
            margin: auto;  
            gap: 20px;
        }

.product {
    width: 200px;
    border: 1px solid #ccc;
    padding: 10px;
    /* text-align: center; */
}

.product img {
    width: 40%;
    height: auto;
    border-radius: 10px;
}

        .product {  
            background: white;  
            border: 1px solid #ddd;  
            border-radius: 8px;  
            padding: 16px;  
            margin: 10px;  
            flex: 1 1 calc(30% - 20px);  
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);  
            transition: transform 0.2s;  
        }  
        .product:hover {  
            transform: scale(1.02);  
        }  
        .product h3 {  
            font-size: 1.2em;  
            margin: 0 0 10px;  
        }  
        .stock {  
            color: green;  
            font-weight: bold;  
        }  
        .price {  
            font-weight: bold;  
            font-size: 1.2em;  
        }  
        .order-button {  
            display: block;  
            background-color: #f39c12;  
            color: white;  
            border: none;  
            padding: 8px 20px;  
            text-align: center;  
            text-decoration: none;  
            border-radius: 5px;  
            cursor: pointer;  
            margin-top: 10px;  
            margin-left: auto;  
            margin-right: 0;  
            transition: background-color 0.3s;  
        }  
        .order-button:hover {  
            background-color: #e67e22;  
        }  
    </style>  
  </head>
  <body>
  <div x-data="setup()" x-init="$refs.loading.classList.add('hidden'); setColors(color);" :class="{ 'dark': isDark}">
      <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
        <!-- Loading screen -->
        <div
          x-ref="loading"
          class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker"
        >
          Loading.....
        </div>

        <!-- Sidebar -->
        <aside class="flex-shrink-0 hidden w-64 bg-white border-r dark:border-primary-darker dark:bg-darker md:block">
          <div class="flex flex-col h-full">
            <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
            <a href="/" class="inline-flex items-center text-2xl font-bold tracking-wider uppercase text-primary-dark dark:text-light">
              <img src="../../Assets/images/FX12 LOGO.png" alt="San Cafe Logo" class="w-12 mr-4">
              <span class="font-bold text-3xl">SAN CAFE</span>
            </a>

            <div x-data="{ isActive: true, open: true}">
                <a
                  href="#"
                  @click="$event.preventDefault(); open = !open"
                  class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                  :class="{'bg-primary-100 dark:bg-primary': isActive || open}"
                  role="button"
                  aria-haspopup="true"
                  :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                  <span aria-hidden="true">
                    <svg
                      class="w-5 h-5"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                      />
                    </svg>
                  </span>
                  <span class="ml-2 text-sm"> Home </span>
                  <span class="ml-auto" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
              </div>
              <div x-data="{ isActive: false, open: false }">
                <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                <a
                  href="#"
                  @click="$event.preventDefault(); open = !open"
                  class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                  :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }"
                  role="button"
                  aria-haspopup="true"
                  :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                  <span aria-hidden="true">
                    <svg
                      class="w-5 h-5"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                      />
                    </svg>
                  </span>
                  <span class="ml-2 text-sm"> Products </span>
                  <span aria-hidden="true" class="ml-auto">
                    <svg
                        class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M19 9l-7 7-7-7"
                        />
                      </svg>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Layouts">
                <a
                      href="../../Views/pages/products.php"
                      role="menuitem"
                      class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
                    >
                    All Products
                    </a>
                    <a
                      href="../../Views/pages/drinks.php"
                      role="menuitem"
                      class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
                    >
                    Drinks
                    </a>
                    <a
                      href="../../Views/pages/nut_products.php"
                      role="menuitem"
                      class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
                    >
                    Nut Products
                    </a>
                    <a
                      href="../../Views/pages/flour_products.php"
                      role="menuitem"
                      class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
                    >
                    Flour Products
                    </a>
                  </div>
              </div>


              <!-- Authentication links -->
              <div x-data="{ isActive: false, open: false}">
                <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                <a
                  href="#"
                  @click="$event.preventDefault(); open = !open"
                  class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                  :class="{'bg-primary-100 dark:bg-primary': isActive || open}"
                  role="button"
                  aria-haspopup="true"
                  :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                  <span aria-hidden="true">
                    <svg
                        class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 6v6h4"
                        />
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                      </svg>
                  </span>
                  <span class="ml-2 text-sm"> History </span>
                  <span aria-hidden="true" class="ml-auto">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
              </div>

              <!-- Layouts links -->
              <div x-data="{ isActive: false, open: false}">
                <a
                    href="#"
                    @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive || open}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'"
                  >
                    <span aria-hidden="true">
                      <svg
                          class="w-5 h-5"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 2a4 4 0 00-4 4v4h8V6a4 4 0 00-4-4z"
                          />
                          <rect x="6" y="10" width="12" height="12" rx="2" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Admin Login </span>
                    <span aria-hidden="true" class="ml-auto">
                    </span>
                  </a>
              </div>
            </nav>

            <!-- Sidebar footer -->
            <div class="flex-shrink-0 px-2 py-4 space-y-2">
              <button
                @click="openSettingsPanel"
                type="button"
                class="flex items-center justify-center w-full px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary-dark focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark"
              >
                <span aria-hidden="true">
                  <svg
                    class="w-4 h-4 mr-2"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                    />
                  </svg>
                </span>
                <span>Customize</span>
              </button>
            </div>
          </div>
        </aside>

        <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
        
        <header class="relative bg-white dark:bg-darker">
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
                    href="../../Views/pages/products.php"
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
                        <img class="w-10 h-10 rounded-full" src="../../Assets/images/pic5.jpg" alt="Ahmed Kamel" />
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
                          <img class="w-10 h-10 rounded-full" src="../../../Assets/images/pic5.jpg" alt="User Profile" />
                          <p class="font-semibold mt-2">MENGSEU SORK</p>
                      </div>
                      <ul class="mt-4 space-y-3">
                        <li class="flex items-center gap-3 p-2 text-gray-700 cursor-pointer hover:text-blue-500 transition">
                          <span class="text-blue-500">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c3.313 0 6-2.686 6-6S15.313 2 12 2 6 4.686 6 8s2.687 6 6 6zM12 14c-4.418 0-8 2.686-8 6v2h16v-2c0-3.314-3.582-6-8-6z"></path>
                            </svg>
                          </span>
                          <a class="block py-2 text-sm text-gray-700 transition-colors dark:text-light dark:hover:bg-primary" href="../user/profile_user.php">Your Profile</a>
                        </li>
                        <li class="flex items-center gap-3 p-2 text-gray-700 cursor-pointer hover:text-blue-500 transition">
                          <span class="text-green-500">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4l4 4-1.414 1.414L14.586 5.414 16 4zM4 14v6h6l8-8-6-6-8 8z"></path>
                            </svg>
                          </span>
                          <a class="block py-2 text-sm text-gray-700 transition-colors dark:text-light dark:hover:bg-primary" href="../user/edit.php">Edit Profile</a>
                        </li>
                        <li class="flex items-center gap-3 p-2 text-gray-700 cursor-pointer hover:text-blue-500 transition">
                          <span class="text-yellow-500">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m-8-8h16"></path>
                            </svg>
                          </span>
                          <a class="block py-2 text-sm text-gray-700 transition-colors dark:text-light dark:hover:bg-primary" href="">Add new profile +</a>
                        </li>
                        <li class="flex items-center gap-3 p-2 text-red-500 cursor-pointer hover:text-red-600 transition">
                          <span class="text-red-500">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                          </span>
                          <a href="">Logout</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </nav>
            </div>
        </header>
        <title>Product Listing</title>  
        <title>Drinks Menu</title>
    <style>
        /* Align the heading to the left */
        h1 {
            text-align: left;
            padding-left: 20px; /* Adds some spacing from the left edge */
            font-size: 24px;
            font-weight: bold;
        }

        /* Adjust the container for better layout */
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        /* Style for the product boxes */
        .product {
            display: flex;
            align-items: center; /* Align items vertically */
            width: 500px; /* Adjust width */
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        /* Style the product images */
        .product img {
            width: 50px; /* Adjust image size */
            height: auto;
            border-radius: 5px;
            margin-right: 15px; /* Space between image and text */
        }

        /* Container for product details */
        .product-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Align text to the left */
        }

        /* Style for product name */
        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        /* Style for product price */
        .price {
            font-size: 16px;
            color: #27ae60; /* Green color for price */
            margin: 5px 0;
        }

        /* Style for stock status */
        .stock {
            font-size: 14px;
            color: #888; /* Gray color for stock */
        }

        /* Style the search bar */
        .search-container {
            text-align: left;
            padding: 20px;
        }

        /* Options container */
        .options {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        /* Order button styling */
        .order-button {
            margin-top: 10px;
            padding: 8px 12px;
            background-color:rgb(253, 205, 30);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .order-button:hover {
            background-color:rgb(0, 238, 103);
        }
    </style>
</head>
<body>

<div class="search-container">
    <input type="text" class="search-box" id="search" placeholder="Search products..." onkeyup="filterProducts()">
    <h1>Drinks</h1>
</div>

<div class="container" id="productContainer">
    <?php  
    $products = [  
        ["name" => "Apple Soda", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/drinks/Apple_soda.jpg"],  
        ["name" => "Cocacola", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/drinks/Coca-cola.jpg"],  
        ["name" => "Coca", "price" => "$1.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Coca.jpg"],  
        ["name" => "Fanta", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Fanta.jpg"],  
        ["name" => "Honey Lemon", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Honey_lemon.jpg"],  
        ["name" => "Mango Juice", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/drinks/Mango_juice.jpg"],  
        ["name" => "Orange Soda", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/orange_soda.jpg"],  
        ["name" => "Pepsi", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Pepsi.jpg"],  
        ["name" => "Sprite", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/drinks/Sprite.jpg"],  
        ["name" => "Sting", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Sting.jpg"],  
        ["name" => "Naturalist", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Naturalist.jpg"],  
        ["name" => "Pineapple Drink", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/drinks/Pineapple_drink.jpg"],  
    ];  

    foreach ($products as $product) {  
        echo '<div class="product">';  
        echo '<img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image">';  
        echo '<div class="product-info">';  
        echo '<h3 class="product-name">' . htmlspecialchars($product['name']) . '</h3>';  
        echo '<p class="stock">' . htmlspecialchars($product['stock']) . '</p>';  
        echo '<p class="price">' . htmlspecialchars($product['price']) . '</p>';  
        echo '<div class="options">';  
        echo '<input type="number" value="1" min="1">';  
        echo '<select>';  
        echo '<option>M</option>';  
        echo '<option>L</option>';  
        echo '<option>S</option>';  
        echo '</select>';  
        echo '</div>';  
        echo '<button class="order-button">Order</button>';  
        echo '</div>'; 
        echo '</div>'; 
    }  
    ?>  
</div>

<script>
function filterProducts() {
    let input = document.getElementById('search').value.toLowerCase();
    let products = document.getElementsByClassName('product');
    
    for (let i = 0; i < products.length; i++) {
        let productName = products[i].getElementsByClassName('product-name')[0].innerText.toLowerCase();
        if (productName.includes(input)) {
            products[i].style.display = "flex";
        } else {
            products[i].style.display = "none";
        }
    }
}
</script>

 
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
    <script src="../../Assets/js/waitslowly.js"></script>
  </body>
</html>
