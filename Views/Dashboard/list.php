
            <!-- Mobile main manu -->
            <div
              class="border-b md:hidden dark:border-primary-darker"
              x-show="isMobileMainMenuOpen"
              @click.away="isMobileMainMenuOpen = false"
              >
              <nav aria-label="Main" class="px-2 py-4 space-y-2">
                <!-- Dashboards links -->
                <div x-data="{ isActive: true, open: true}">
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
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        />
                      </svg>
                    </span>
                    <span class="ml-2 text-sm"> Dashboards </span>
                  </a>
                </div>

                <!-- Components links -->
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
                    <span class="ml-2 text-sm"> Components </span>
                    <span aria-hidden="true" class="ml-auto">
                      <!-- active class 'rotate-180' -->
                      <svg
                        class="w-4 h-4 transition-transform transform"
                        :class="{ 'rotate-180': open }"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                      </svg>
                    </span>
                  </a>
                  <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Components">
                    <a
                      href="#"
                      role="menuitem"
                      class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
                    >
                      Alerts (soon)
                    </a>
                    <a
                      href="#"
                      role="menuitem"
                      class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
                    >
                      Buttons (soon)
                    </a>
                    <a
                      href="#"
                      role="menuitem"
                      class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                    >
                      Cards (soon)
                    </a>
                    <a
                      href="#"
                      role="menuitem"
                      class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                    >
                      Dropdowns (soon)
                    </a>
                    <a
                      href="#"
                      role="menuitem"
                      class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                    >
                      Forms (soon)
                    </a>
                    <a
                      href="#"
                      role="menuitem"
                      class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                    >
                      Lists (soon)
                    </a>
                    <a
                      href="#"
                      role="menuitem"
                      class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                    >
                      Modals (soon)
                    </a>
                  </div>
                </div>

                <!-- Pages links -->
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
                          d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                        />
                      </svg>
                    </span>
                    <span class="ml-2 text-sm"> Pages </span>
                  </a>
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
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                        />
                      </svg>
                    </span>
                    <span class="ml-2 text-sm"> Authentication </span>
                  </a>
                </div>

                <!-- Layouts links -->
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
                          d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                        />
                      </svg>
                    </span>
                    <span class="ml-2 text-sm"> Layouts </span>
                  </a>
                </div>
              </nav>
            </div>
        </header>
          <main class="flex-1 h-full overflow-x-hidden overflow-y-auto">
            <!-- Content -->
            <div class="mt-2">
              <!-- State cards -->
              <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
                <!-- Value card -->
                <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                  <div>
                    <h6
                      class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"
                    >
                      Value
                    </h6>
                    <span class="text-xl font-semibold">$30,000</span>
                    <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                      +4.4%
                    </span>
                  </div>
                  <div>
                    <span>
                      <svg
                        class="w-12 h-12 text-gray-300 dark:text-primary-dark"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                      </svg>
                    </span>
                  </div>
                </div>

                <!-- Users card -->
                <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                  <div>
                    <h6
                      class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"
                    >
                      Users
                    </h6>
                    <span class="text-xl font-semibold">50,021</span>
                    <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                      +2.6%
                    </span>
                  </div>
                  <div>
                    <span>
                      <svg
                        class="w-12 h-12 text-gray-300 dark:text-primary-dark"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                        />
                      </svg>
                    </span>
                  </div>
                </div>

                <!-- Orders card -->
                <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                  <div>
                    <h6
                      class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"
                    >
                      Orders
                    </h6>
                    <span class="text-xl font-semibold">45,021</span>
                    <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                      +3.1%
                    </span>
                  </div>
                  <div>
                    <span>
                      <svg
                        class="w-12 h-12 text-gray-300 dark:text-primary-dark"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                        />
                      </svg>
                    </span>
                  </div>
                </div>

                <!-- Tickets card -->
                <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                  <div>
                    <h6
                      class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"
                    >
                      Tickets
                    </h6>
                    <span class="text-xl font-semibold">20,516</span>
                    <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                      +3.1%
                    </span>
                  </div>
                  <div>
                    <span>
                      <svg
                        class="w-12 h-12 text-gray-300 dark:text-primary-dark"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"
                        />
                      </svg>
                    </span>
                  </div>
                </div>
              </div>

              <!-- Charts -->
              <div class="grid grid-cols-2 gap-4 ml-4 mr-4 mb-24">
                <!-- Bar Chart -->
                <div class="bg-white rounded-md dark:bg-darker p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold">Bar Chart</h2>
                    <canvas id="barChart"></canvas>
                </div>
                
                <!-- Doughnut Chart -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold">Doughnut Chart</h2>
                    <canvas id="doughnutChart"></canvas>
                </div>

                <!-- Active Users Chart -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold">Active Users</h2>
                    <p class="text-2xl font-bold">40 Users</p>
                    <canvas id="activeUsersChart"></canvas>
                </div>

                <!-- Line Chart -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold">Line Chart</h2>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>

              <!-- Two grid columns -->
            </div>
          </main>
        <div
          x-transition:enter="transition duration-300 ease-in-out"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition duration-300 ease-in-out"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
          x-show="isSettingsPanelOpen"
          @click="isSettingsPanelOpen = false"
          class="fixed inset-0 z-10 bg-primary-darker"
          style="opacity: 0.5"
          aria-hidden="true"
        ></div>
        <!-- Panel -->
         <?php require_once 'section.php'?>
      </div>
    </div>
    

    <script>
        // Bar Chart
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales',
                    data: [80, 30, 20, 90, 40, 50, 100, 60, 30, 90, 60, 50],
                    backgroundColor: 'rgba(192, 0, 255, 0.6)',
                }]
            }
        });

        // Doughnut Chart
        new Chart(document.getElementById('doughnutChart'), {
            type: 'doughnut',
            data: {
                labels: ['Oct', 'Nov', 'Dec'],
                datasets: [{
                    data: [50, 30, 20],
                    backgroundColor: ['#C000FF', '#E080FF', '#FF40FF']
                }]
            }
        });

        // Active Users Chart
        new Chart(document.getElementById('activeUsersChart'), {
            type: 'bar',
            data: {
                labels: Array.from({length: 30}, (_, i) => i + 1),
                datasets: [{
                    label: 'Active Users',
                    data: Array.from({length: 30}, () => Math.floor(Math.random() * 50)),
                    backgroundColor: 'rgba(192, 0, 255, 0.6)'
                }]
            }
        });

        // Line Chart
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Growth',
                    data: [50, 45, 30, 60, 40, 70, 90, 80, 60, 100, 110, 95],
                    borderColor: '#C000FF',
                    fill: false
                }]
            }
        });
    </script>