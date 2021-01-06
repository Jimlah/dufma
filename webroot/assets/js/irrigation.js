gsap.to('body',0,{
    opacity:1
})

gsap.from('.header-text',1,{
    'opacity':0,
    y:60
})

gsap.from('.header-text p',0.8,{
    'opacity':0,
    y:60,
    delay:1
})

gsap.from('.header-text button',0.6,{
    'opacity':0,
    y:60,
    delay:2
})

let topgetter = (element) =>{
    return document.querySelector(element).getBoundingClientRect().top
}

window.onscroll = () =>{
    var features = document.querySelector('#features')
    var featuresTop = features.getBoundingClientRect().top
    var decisiveHeight = window.innerHeight / 1.2
    var course_text_top = topgetter('.course-row')
   if (featuresTop < decisiveHeight){
       gsap.to('#feature1',1,{
           x:0,
           ease: "elastic.out(1, 0.3)"
       })
       gsap.to('#feature2',0.9,{
           y:0,
           ease: "elastic.out(1, 0.3)"
       })
       gsap.to('#feature3',0.8,{
           x:0,
           ease: "elastic.out(1, 0.3)"
       })
   }
   if(course_text_top < decisiveHeight){
       gsap.to('.course-text',1,{
            opacity:1,
            y:0
       })
       gsap.to('.course-right-col',1,{
           opacity:1,
           y:0,
           delay:0.5
       })
   }
   if(topgetter('#offer') < decisiveHeight){
       gsap.to('.offer-right-col',1,{
            opacity:1,
            y:0,
       })
       gsap.to('.offer-left-col',1,{
        opacity:1,
        y:0,
        delay:0.5
    
   })
       
   }

   if(topgetter('#contact') < decisiveHeight){
       gsap.to('#contact',1,{
           opacity:1,
           y:0
       })
   }
}

