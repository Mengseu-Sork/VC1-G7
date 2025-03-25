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

<script src="../../Assets/js/notifications.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchNotifications();

        document.getElementById('notification-button').addEventListener('click', function() {
            document.getElementById('notification-panel').classList.toggle('hidden');
        });

        document.getElementById('mark-all-read').addEventListener('click', function() {
            markAllAsRead();
        });
    });

    function fetchNotifications() {
        fetch('/notifications/get')
            .then(response => response.json())
            .then(data => {
                const notificationList = document.getElementById('notification-list');
                notificationList.innerHTML = '';

                if (data.notifications.length > 0) {
                    data.notifications.forEach(notification => {
                        const notificationItem = document.createElement('div');
                        notificationItem.classList.add('p-4', 'hover:bg-gray-100', 'cursor-pointer');
                        notificationItem.innerHTML = `
                            <p>${notification.message}</p>
                            <small class="text-gray-500">${notification.time_ago}</small>
                        `;
                        notificationList.appendChild(notificationItem);
                    });

                    document.getElementById('notification-badge').classList.remove('hidden');
                    document.getElementById('notification-badge').textContent = data.unreadCount;
                } else {
                    notificationList.innerHTML = '<div class="p-4 text-center text-gray-500">No notifications</div>';
                }
            });
    }

    function markAllAsRead() {
        fetch('/notifications/mark-all-read', { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchNotifications();
                    document.getElementById('notification-badge').classList.add('hidden');
                }
            });
    }
</script>