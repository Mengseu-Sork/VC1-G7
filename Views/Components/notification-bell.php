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

