importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyClLVIJlqMbPCFalAuI858U5WoKpM2D-7A",
    projectId: "test-job-2c7b6",
    messagingSenderId: "889127199367",
    appId: "1:889127199367:web:ec69b866cfd1d5e36bce22",
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});
