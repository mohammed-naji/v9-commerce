import './bootstrap';
var userId = 1;
Echo.private('App.Models.User.' + userId)
    .notification((notification) => {
        toastr.success(notification.msg)

        console.log(notification);
    });
