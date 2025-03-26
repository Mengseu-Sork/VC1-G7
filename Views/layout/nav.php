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
              <img src="../../../Assets/images/FX12 LOGO.png" alt="San Cafe Logo" class="w-12 mr-4">
              <span class="font-bold text-3xl">SAN CAFE</span>
            </a>

            <div>
                <a
                  href="/"
                  class=".sidebar-item flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                >
                  <span aria-hidden="true">
                    <i class="fas fa-home icon text-blue-500"></i>
                  </span>
                  <span class="ml-2 text-5sm"> Dashboards </span>
                  <span class="ml-auto" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
              </div>
              <div>
                <a
                  href="/pages"
                  class=".sidebar-item flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                >
                  <span aria-hidden="true">
                    <i class="fas fa-cube icon text-blue-500"></i>
                  </span>
                  <span class="ml-3 text-5sm "> Products </span>
                  <span class="ml-auto" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
              </div>
              <div>
                <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                <a
                  href="/products"
                  class=".sidebar-item flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"

                >
                  <span aria-hidden="true">
                    <i class="fas fa-box icon text-blue-500"></i> 
                  <span class="ml-2 text-5sm"> Inventory </span>
                </a>
              </div>
              <div>
                <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                <a
                  href="/categories"
                  class=".sidebar-item flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"

                >
                  <span aria-hidden="true">
                  <i class="fas fa-list icon text-blue-500"></i>
                  <span class="ml-2 text-5sm"> Category </span>
                </a>
              </div>

              <!-- Pages links -->
              <div>
                <a
                  href="#"
                  class=".sidebar-item flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                >
                  <span aria-hidden="true">
                    <i class="fas fa-file-alt icon text-blue-500"></i>
                  </span>
                  <span class="ml-4 text-5sm"> Report </span>
                  <span aria-hidden="true" class="ml-auto">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
              </div>

              <!-- Authentication links -->
              <div>
                <a
                  href="#"
                  class=".sidebar-item flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"

                >
                  <span aria-hidden="true">
                    <i class="fas fa-shopping-cart icon text-blue-500"></i>
                  </span>
                  <span class="ml-2 text-5sm"> Order </span>
                  <span aria-hidden="true" class="ml-auto">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
              </div>

              <!-- Layouts links -->
              <div>
                <a
                    href="#"
                    class=".sidebar-item flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"

                  >
                    <span aria-hidden="true">
                      <i class="fas fa-dollar-sign icon1 text-blue-500"></i>
                    </span>
                    <span class="ml-4 text-5sm"> Payments </span>
                    <span aria-hidden="true" class="ml-auto">
                    </span>
                  </a>
              </div>
              <div>
                <a
                  href="/user"
                  class=".sidebar-item flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                  >
                  <span aria-hidden="true">
                    <i class="fas fa-users icon text-blue-500"></i>
                  </span>
                  <span class="ml-2 text-sm"> Users </span>
                  <span aria-hidden="true" class="ml-auto">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
              </div>
              <div>
                <a
                  href="/auth/signout"
                  class=".sidebar-item flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                >
                  <span aria-hidden="true">
                    <i class="fas fa-sign-out-alt icon text-blue-500"></i>
                  </span>
                  <span class="ml-3 text-5sm"> Sign Out </span>
                </a>
              </div>

            </nav>
          </div>
        </aside>
        <div class="flex-1 h-full overflow-hidden">
          <header class="flex-1 bg-white dark:bg-darker"> 
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

                          <!-- Add this where you want the notification bell to appear -->
                          <div class="relative" id="notification-bell">
    <button
        id="notification-button"
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
        <span id="notification-badge" class="hidden absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
    </button>
    
    <!-- Notification Panel -->
    <div id="notification-panel" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg overflow-hidden z-50 max-h-96 overflow-y-auto">
        <div class="py-2 border-b border-gray-200 flex justify-between items-center px-4">
            <h3 class="text-lg font-medium">Notifications</h3>
            <button id="mark-all-read" class="text-sm text-blue-500 hover:text-blue-700">Mark all as read</button>  
        </div>
        <div id="notification-list" class="divide-y divide-gray-200">
            <!-- Notifications will be loaded here -->
            <div class="p-4 text-center text-gray-500">Loading notifications...</div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const notificationButton = document.getElementById('notification-button');
    const notificationPanel = document.getElementById('notification-panel');
    const notificationBadge = document.getElementById('notification-badge');
    const notificationList = document.getElementById('notification-list');
    const markAllReadButton = document.getElementById('mark-all-read');
    
    let isOpen = false;
    
    // Toggle notification panel
    notificationButton.addEventListener('click', function() {
        isOpen = !isOpen;
        if (isOpen) {
            notificationPanel.classList.remove('hidden');
            fetchNotifications();
        } else {
            notificationPanel.classList.add('hidden');
        }
    });
    
    // Close panel when clicking outside
    document.addEventListener('click', function(event) {
        if (isOpen && !notificationButton.contains(event.target) && !notificationPanel.contains(event.target)) {
            isOpen = false;
            notificationPanel.classList.add('hidden');
        }
    });
    
    // Mark all as read
    markAllReadButton.addEventListener('click', function() {
        fetch('/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchNotifications();
            }
        })
        .catch(error => console.error('Error marking all as read:', error));
    });
    
    // Fetch notifications
    function fetchNotifications() {
        fetch('/notifications/get')
        .then(response => response.json())
        .then(data => {
            updateNotificationBadge(data.unreadCount);
            renderNotifications(data.notifications);
        })
        .catch(error => {
            console.error('Error fetching notifications:', error);
            notificationList.innerHTML = '<div class="p-4 text-center text-gray-500">Failed to load notifications</div>';
        });
    }
    
    // Update notification badge
    function updateNotificationBadge(count) {
        if (count > 0) {
            notificationBadge.textContent = count > 9 ? '9+' : count;
            notificationBadge.classList.remove('hidden');
        } else {
            notificationBadge.classList.add('hidden');
        }
    }
    
    // Render notifications
    function renderNotifications(notifications) {
        if (notifications.length === 0) {
            notificationList.innerHTML = '<div class="p-4 text-center text-gray-500">No notifications</div>';
            return;
        }
        
        let html = '';
        notifications.forEach(notification => {
            const timeAgo = getTimeAgo(new Date(notification.created_at));
            const isUnread = notification.is_read == 0;
            
            html += `
                <div class="notification-item p-4 ${isUnread ? 'bg-blue-50' : ''}" data-id="${notification.id}">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-0.5">
                            <div class="w-2 h-2 rounded-full ${isUnread ? 'bg-blue-600' : 'bg-gray-300'}"></div>
                        </div>
                        <div class="ml-3 w-0 flex-1">
                            <p class="text-sm text-gray-900">${notification.message}</p>
                            <p class="mt-1 text-xs text-gray-500">${timeAgo}</p>
                        </div>
                    </div>
                </div>
            `;
        });
        
        notificationList.innerHTML = html;
        
        // Add click event to mark as read
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                const id = this.dataset.id;
                markAsRead(id);
            });
        });
    }
    
    // Mark notification as read
    function markAsRead(id) {
        fetch('/notifications/mark-as-read', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchNotifications();
            }
        })
        .catch(error => console.error('Error marking as read:', error));
    }
    
    // Helper function to format time ago
    function getTimeAgo(date) {
        const seconds = Math.floor((new Date() - date) / 1000);
        
        let interval = Math.floor(seconds / 31536000);
        if (interval > 1) return interval + ' years ago';
        if (interval === 1) return '1 year ago';
        
        interval = Math.floor(seconds / 2592000);
        if (interval > 1) return interval + ' months ago';
        if (interval === 1) return '1 month ago';
        
        interval = Math.floor(seconds / 86400);
        if (interval > 1) return interval + ' days ago';
        if (interval === 1) return '1 day ago';
        
        interval = Math.floor(seconds / 3600);
        if (interval > 1) return interval + ' hours ago';
        if (interval === 1) return '1 hour ago';
        
        interval = Math.floor(seconds / 60);
        if (interval > 1) return interval + ' minutes ago';
        if (interval === 1) return '1 minute ago';
        
        return 'just now';
    }
    
    // Check for new notifications periodically
    setInterval(function() {
        if (!isOpen) {
            fetch('/notifications/get')
            .then(response => response.json())
            .then(data => {
                updateNotificationBadge(data.unreadCount);
            })
            .catch(error => console.error('Error checking notifications:', error));
        }
    }, 30000); // Check every 30 seconds
    
    // Initial fetch
    fetch('/notifications/get')
    .then(response => response.json())
    .then(data => {
        updateNotificationBadge(data.unreadCount);
    })
    .catch(error => console.error('Error checking notifications:', error));
});
</script>



<?php 
// include_once 'Views/Components/notification-bell.php'; 
?>
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
                              <img class="w-10 h-10 rounded-full" src="../../../Assets/images/user/pic5.jpg" alt="Ahmed Kamel" />
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
                                <img class="w-10 h-10 rounded-full" src="../../../../Assets/images/user/pic5.jpg" alt="User Profile" />
                                <p class="font-semibold mt-2">MENGSEU SORK</p>
                            </div>
                            <ul class="mt-2 ml-4 space-y-2">
                              <li class="flex items-center gap-3 p-1 text-gray-700 hover:text-blue-500 cursor-pointer">
                                  <i class="fas fa-user"></i>
                                </span>
                                <a class="block py-2 text-sm text-gray-700 transition-colors dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400 nav-link" href="views/profile/showuser.php">Your Profile</a>
                              </li>
                              <li class="flex items-center gap-3 p-1 text-gray-700 hover:text-blue-500 cursor-pointer">
                                <span class="text-green-500">
                                  <i class="fas fa-pencil-alt"></i>
                                </span>
                                <a  class="block py-2 text-sm text-gray-700 transition-colors dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400" href="user/edit">Edit Profile</a>
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
        