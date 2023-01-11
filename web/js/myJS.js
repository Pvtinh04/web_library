//Prevent resend request when refresh page:
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}