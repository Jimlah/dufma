let notificationsd = document.querySelector('.notifications_')
notificationCountd = document.querySelector('.notifier a span')
let notifier = document.querySelector('.notifier');

window.onload = () => {
    var notificationListCount  = document.querySelectorAll('.user_notification').length
    notificationCountd.innerHTML = notificationListCount
    if(notificationListCount == 0){
        console.log(notificationCountd)
        notificationCountd.style.display = 'none'
    }
    
}

notifier.addEventListener('click',() => {
    notificationsd.classList.toggle('jq')
})