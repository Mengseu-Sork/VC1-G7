
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
        <aside class="flex-shrink-0 hidden w-64 bg-white dark:bg-darker md:block">
          <div class="flex flex-col h-full">
            <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2">
              <a href="/Dashboard" class="flex flex-col items-center items-start mb-4 mt-2 text-primary-dark dark:text-light">
                <img src="../../../Assets/images/FX12 LOGO.png" alt="San Cafe Logo" class="w-16 mb-2">
                <span class="font-bold text-3xl tracking-wider uppercase">SAN CAFE</span>
              </a>
              <div class="space-y-3 overflow-y-auto">
              <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <div>
                  <a
                    href="/Dashboard"
                    class="sidebar-link flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    >
                    <span aria-hidden="true">
                      <i class="fas fa-home icon text-blue-500 dark:text-light"></i>
                    </span>
                    <span class="ml-2 text-5sm"> Dashboards </span>
                    <span class="ml-auto" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                      </svg>
                    </span>
                  </a>
                </div>
                <?php endif; ?>

                <div>
                  <a
                    href="/pages"
                    class="sidebar-link flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                  >
                    <span aria-hidden="true">
                      <i class="fas fa-cube icon text-blue-500 dark:text-light"></i>
                    </span>
                    <span class="ml-3 text-5sm "> Products </span>
                    <span class="ml-auto" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                      </svg>
                    </span>
                  </a>
                </div>

                <div>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>

                  <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                  <a
                    href="/products"
                    class="sidebar-link flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"

                  >
                    <span aria-hidden="true">
                      <i class="fas fa-box icon text-blue-500 dark:text-light"></i> 
                    <span class="ml-2 text-5sm"> Inventory </span>
                  </a>
                  <?php endif; ?>
                </div>

                <div>
                  <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                  <a
                    href="/stock"
                    class="sidebar-link flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"

                  >
                    <span aria-hidden="true">
                      <i class="fas fa-warehouse warehouse-icon text-blue-500 dark:text-light"></i>
                    <span class="ml-5 text-5sm"> Stock </span>
                  </a>
                </div>

                <div>
                  <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                  <a
                    href="/categories"
                    class="sidebar-link flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"

                  >
                    <span aria-hidden="true">
                    <i class="fas fa-list icon text-blue-500 dark:text-light"></i>
                    <span class="ml-2 text-5sm"> Category </span>
                  </a>
                </div>

                <!-- Authentication links -->
                <div>
                  <a
                    href="/orders/orderHistory"
                    class="sidebar-link flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"

                  >
                    <span aria-hidden="true">
                      <i class="fas fa-shopping-cart icon text-blue-500 dark:text-light"></i>
                    </span>
                    <span class="ml-2 text-5sm"> History Order </span>
                    <span aria-hidden="true" class="ml-auto">
                    </span>
                  </a>
                </div>

                <!-- Layouts links -->
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <div>
                  <a
                      href="/payments/payment"
                      class="sidebar-link flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"

                    >
                      <span aria-hidden="true">
                        <i class="fas fa-dollar-sign icon1 text-blue-500 dark:text-light"></i>
                      </span>
                      <span class="ml-4 text-5sm"> Payments </span>
                      <span aria-hidden="true" class="ml-auto">
                      </span>
                    </a>
                </div>
                <div>
                  <a
                    href="/user"
                    class="sidebar-link flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    >
                    <span aria-hidden="true">
                      <i class="fas fa-users icon text-blue-500 dark:text-light"></i>
                    </span>
                    <span class="ml-2 text-sm"> Users </span>
                    <span aria-hidden="true" class="ml-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                      </svg>
                    </span>
                  </a>
                </div>
                <?php endif; ?>
                <div>
                  <a
                    href="/"
                    class="sidebar-link flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                  >
                    <span aria-hidden="true">
                      <i class="fas fa-sign-out-alt icon text-blue-500 dark:text-light"></i>
                    </span>
                    <span class="ml-3 text-5sm"> Logout </span>
                  </a>
                </div>
              </div>
            </nav>
          </div>
        </aside>
        <div class="flex-1 h-full overflow-hidden">
          <header class="flex-1 bg-white dark:bg-darker"> 
                  <div class="flex items-center justify-between p-2">
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
                          href="/"
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
                      <nav aria-label="Secondary" class="hidden space-x-4 md:flex md:items-center">
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

                         
                          <?php require_once "./Views/Components/notification-system.php"?>

                          <!-- Color button -->
                          <?php require_once './Views/layout/colorNavbar.php'?>
                          <?php require_once './Views/user/buttonUser.php'?>
                      </nav>
                  </div>
          </header>           

       