
<div class="relative">
  <button id="bellIcon" class="relative focus:outline-none ">
    🔔
    <span id="notifCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1 rounded-full">0</span>
  </button>

  <!-- Dropdown -->
  <div id="notificationDropdown" class="absolute right-0 mt-2 w-80 bg-white border rounded shadow-lg hidden z-50">
    <div class="p-2 font-bold text-gray-700 border-b">Notifications</div>
    <div id="notificationList" class="max-h-60 overflow-y-auto"></div>
    <button onclick="clearNotifications()" class="w-full bg-blue-500 hover:bg-blue-600 text-white text-sm py-2">Clear All</button>
  </div>
</div>
<script>
// Store notifications
function storeOutOfStockNotifications(products) {
    if (!Array.isArray(products) || products.length === 0) return;

    let notifications = JSON.parse(localStorage.getItem('notifications')) || [];

    products.forEach(product => {
    const message = `Product "${product}" is out of stock.`;
    const exists = notifications.some(n => n.message === message);
    if (!exists) {
        alert(message); // ✅ This will show a popup
        notifications.push({
            message,
            timestamp: new Date().toISOString(),
            status: 'unread'
        });
    }
});

    localStorage.setItem('notifications', JSON.stringify(notifications));
    updateNotificationUI();
}

// Update bell count and list
function updateNotificationUI() {
    const notifications = JSON.parse(localStorage.getItem('notifications')) || [];
    const unread = notifications.filter(n => n.status === 'unread');

    document.getElementById('notifCount').textContent = unread.length;

    const list = document.getElementById('notificationList');
    list.innerHTML = unread.length === 0
        ? '<div class="p-2 text-sm text-gray-500">No new notifications.</div>'
        : unread.map(n => `<div class="p-2 text-sm text-gray-700 border-b">${n.message}</div>`).join('');
}

// Clear all notifications
function clearNotifications() {
    localStorage.removeItem('notifications');
    updateNotificationUI();
}

// Toggle dropdown
document.getElementById('bellIcon').addEventListener('click', () => {
    document.getElementById('notificationDropdown').classList.toggle('hidden');
    updateNotificationUI();
});

// On page load
updateNotificationUI();

// Auto-store from PHP if available
if (typeof outOfStockItems !== 'undefined') {
    storeOutOfStockNotifications(outOfStockItems);
}
</script>
