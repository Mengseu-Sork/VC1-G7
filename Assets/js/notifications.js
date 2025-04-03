function loadNotifications() {
  fetch("/api/notifications")
      .then((response) => response.json())
      .then((data) => {
          updateNotificationsList(data.notifications);
          updateUnreadCount(data.unreadCount);
      })
      .catch((error) => {
          console.error("Error loading notifications:", error);
      });
}

function markAsRead(id) {
  fetch("/api/notifications/mark-read", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id=${id}`,
  })
      .then((response) => response.json())
      .then((data) => {
          if (data.success) {
              loadNotifications();
          }
      })
      .catch((error) => {
          console.error("Error marking notification as read:", error);
      });
}

function markAllAsRead() {
  fetch("/api/notifications/mark-all-read", {
      method: "POST",
  })
      .then((response) => response.json())
      .then((data) => {
          if (data.success) {
              loadNotifications();
          }
      })
      .catch((error) => {
          console.error("Error marking all notifications as read:", error);
      });
}
