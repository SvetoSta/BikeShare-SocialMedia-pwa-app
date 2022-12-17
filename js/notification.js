var $status = document.getElementById('status');

if ('Notification' in window) {
  $status.innerText = Notification.permission;
}

function requestPermission() {
  if (!('Notification' in window)) {
    alert('Notification API not supported!');
    return;
  }
  
  Notification.requestPermission(function (result) {
    $status.innerText = result;
  });
}

function nonPersistentNotification() {
  if (!('Notification' in window)) {
    alert('Notification API not supported!');
    return;
  }
  
  try {
    var notification = new Notification("#");
  } catch (err) {
    alert('Notification API error: ' + err);
  }
}

function persistentNotification(userPoints) {
  if (!('Notification' in window) || !('ServiceWorkerRegistration' in window)) {
    alert('Persistent Notification API not supported!');
    return;
  }
 
  try {
    navigator.serviceWorker.getRegistration()
      .then((reg) => reg.showNotification("Congratulation! You just scored " + userPoints + " points."))
      .catch((err) => alert('Service Worker registration error: ' + err));
      navigator.vibrate([100, 200, 200, 200, 500]);
  } catch (err) {
    alert('Notification API error: ' + err);
  }
}
  function persistentNotification2() {
    if (!('Notification' in window) || !('ServiceWorkerRegistration' in window)) {
      alert('Persistent Notification API not supported!');
      return;
    }
  
  try {
    navigator.serviceWorker.getRegistration()
      .then((reg) => reg.showNotification("Your screen will now stay active during your ride!"))
      .catch((err) => alert('Service Worker registration error: ' + err));
      navigator.vibrate([100, 200]);
  } catch (err) {
    alert('Notification API error: ' + err);
  }
}