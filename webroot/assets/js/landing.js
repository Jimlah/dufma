let heroImgs = document.querySelectorAll('.hero img')
let circles = document.querySelectorAll('.bubbles > span')
if (heroImgs.length >0){

var all = 0
swap = () => {
    circles.forEach(circle => {
        circle.classList.remove('active')
    })
    if (all === 3) {
        all = 0
    }
    circles[all].classList.add('active')
    all += 1;
}

setInterval(swap, 4000)

heroImgs[0].style.zIndex = 4
heroImgs[1].style.zIndex = 3
heroImgs[2].style.zIndex = 2

let tl = new TimelineMax({ yoyo: true, repeat: -1, repeatDelay: 10 });
tl.to(heroImgs[0], 1, {
    yPercent: '100',
    delay: 5,
    ease: 'Power2.easeInOut'
})



tl.to('.hero .text1', 1, {
    autoAlpha: 0
})



tl.to('.hero .text2', 1, {
    autoAlpha: 1
})


tl.to(heroImgs[1], 1, {
    yPercent: '-100',
    delay: 5,
    ease: 'Power2.easeInOut'
})

tl.to('.hero .text2', 1, {
    autoAlpha: 0
})

tl.to('.hero .text3', 1, {
    autoAlpha: 1
})

}
let mobileHam = document.querySelector('.mobile_ham');
let mobileNav = document.querySelector('.mobile_nav');
mobileHam.addEventListener('click', () => {
    mobileHam.classList.toggle('active')
    mobileNav.classList.toggle('active')
})
let parent1 = document.querySelector('.parent1');
let child1 = document.querySelector('.child1')
let parent2 = document.querySelector('.parent2');
let child2 = document.querySelector('.child2')

parent1.addEventListener('click', () => {
    child1.classList.toggle('active')
})
parent2.addEventListener('click', () => {
    child2.classList.toggle('active')
})