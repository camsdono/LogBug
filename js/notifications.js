/*
const button = document.getElementById('notification-button');

button.addEventListener('click', () => {
    Notification.requestPermission().then(permission => {
        if (permission === 'granted') {
            const notification = new Notification('Hello World!', {
                body: "This is more text",
                data: { hello: "world" }
            })

            notification.addEventListener('error', e => {
                alert("error");
            })
        }
    });

});

*/

function notification(title, message) {
    console.log("Confirm this is working")
    Notification.requestPermission().then(permission => {
        if (permission === 'granted') {
            const notification = new Notification('Hello World!', {
                body: "This is more text",
                data: { hello: "world" }
            })

            notification.addEventListener('error', e => {
                alert("error");
            })
        }
    });
}