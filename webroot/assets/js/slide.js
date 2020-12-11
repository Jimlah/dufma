var slideIndex = 0;
var slides = document.getElementsByClassName("mySlides");
if(slides.length !== 0){
  showSlides();
}

function showSlides() {
  var i;
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 7000); // Change image every 7 seconds
}

var slideIndex2 = 0;
var slides2 = document.getElementsByClassName("mySlides2");
if(slides2.length !==0 ){
  showSlides2();
}

function showSlides2() {
  var i;
  for (i = 0; i < slides2.length; i++) {
    slides2[i].style.display = "none";
  }
  slideIndex2++;
  if (slideIndex2 > slides.length) {slideIndex2 = 1}
  slides2[slideIndex2-1].style.display = "block";
  setTimeout(showSlides2, 5000); // Change image every 7 seconds
}