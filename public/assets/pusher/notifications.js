

// channel.bind('my-event', function(data) {
//     var currentCount = parseInt(document.getElementById('notificationCount').textContent);
//     var newCount = currentCount + 1;
//     document.getElementById('notificationCount').textContent = newCount;

//     fetchNotifications(); 
//     simulateButtonClick();
// });

// Echo.channel('my-channel')
//     .listen('UserRegistration', () => {
//         let currentCount = parseInt(document.getElementById('notificationCount').textContent);
//         let newCount = currentCount + 1;
//         document.getElementById('notificationCount').textContent = newCount;

//         fetchNotifications(); 
//         simulateButtonClick();
//     });

    Echo.channel(`my-channel`)
    .listen('UserRegestratoin', (e) => {
        let currentCount = parseInt(document.getElementById('notificationCount').textContent);
             let newCount = currentCount + 1;
             document.getElementById('notificationCount').textContent = newCount;
        
            fetchNotifications(); 
            simulateButtonClick();
    });

function simulateButtonClick() {
    var button = document.getElementById('toastr-one');
    if (button) {
        button.click();
    }
}
function timeSince(date) {
    const seconds = Math.floor((new Date() - new Date(date)) / 1000);
    let interval = seconds / 31536000;

    if (interval > 1) {
        return Math.floor(interval) + " years ago";
    }
    interval = seconds / 2592000;
    if (interval > 1) {
        return Math.floor(interval) + " months ago";
    }
    interval = seconds / 86400;
    if (interval > 1) {
        return Math.floor(interval) + " days ago";
    }
    interval = seconds / 3600;
    if (interval > 1) {
        return Math.floor(interval) + " hours ago";
    }
    interval = seconds / 60;
    if (interval > 1) {
        return Math.floor(interval) + " minutes ago";
    }
    return Math.floor(seconds) + " seconds ago";
}
function fetchNotifications() {
    fetch('/notifications')
        .then(response => response.json())
        .then(data => {
            document.getElementById('notificationCount').textContent = data.notifications.length;
            const notificationList = document.getElementById('notificationList');
            notificationList.innerHTML = ''; 
            data.notifications.forEach(notification => {
                const notificationItem = document.createElement('div');
                notificationItem.classList.add('dropdown-item', 'notify-item');
                notificationItem.innerHTML = `
                    <form id="clearNotif">
                    <a href="{{route('clinets_list')}}" class="notification-link">
                        <div class="notify-icon bg-warning-subtle">
                            <i class="mdi mdi-account-plus text-warning"></i>
                        </div>
                        <div class="notify-details">
                            ${notification.data.message}
                            <small class="text-dark noti-time">${timeSince(notification.created_at)}</small>
                        </div>
                    </a>
                    </form>
                `;
                notificationList.appendChild(notificationItem);
            });
        })
        .catch(error => console.error(error));
}
