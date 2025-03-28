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
            if (data.notifications) {
                updateNotificationBadge(data.unreadCount);
                renderNotifications(data.notifications);
            } else {
                throw new Error('Failed to load notifications');
            }
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
            const isUnread = notification.is_read == 0;
            const productLink = notification.related_type === 'product' && notification.related_id ? 
                `/products/details?id=${notification.related_id}` : null;
            
            html += `
                <div class="notification-item p-4 ${isUnread ? 'bg-blue-50' : ''}" 
                     data-id="${notification.id}" 
                     ${productLink ? `data-product-id="${notification.related_id}"` : ''}>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-0.5">
                            <div class="w-2 h-2 rounded-full ${isUnread ? 'bg-blue-600' : 'bg-gray-300'}"></div>
                        </div>
                        <div class="ml-3 w-0 flex-1">
                            <p class="text-sm text-gray-900">
                                ${productLink ? 
                                    `<a href="${productLink}" class="hover:text-blue-600">${notification.message}</a>` : 
                                    notification.message}
                            </p>
                            <p class="mt-1 text-xs text-gray-500">${notification.time_ago}</p>
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
                
                // If notification has a product link, navigate to it
                const productId = this.dataset.productId;
                if (productId) {
                    window.location.href = `/products/details?id=${productId}`;
                }
            });
        });
    }
    
    // Mark notification as read
    function markAsRead(id) {
        const formData = new FormData();
        formData.append('id', id);
        
        fetch('/notifications/mark-as-read', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchNotifications();
            }
        })
        .catch(error => console.error('Error marking as read:', error));
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