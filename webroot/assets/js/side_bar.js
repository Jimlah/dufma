var user_trigger = document.querySelectorAll(".user__dets");
var user_dets_list = document.querySelectorAll("#user_dets_list");
var arrow = document.querySelectorAll("#arrow");

if(user_trigger.length !==0 ){

    user_trigger[0].addEventListener("click",function(){
        user_dets_list[0].classList.toggle("block");
        arrow[0].classList.toggle('rotated');
        // arrow[0].classList.toggle('arrow_special');
    });
    user_trigger[1].addEventListener("click",function(){
        user_dets_list[1].classList.toggle("block");
        arrow[1].classList.toggle("rotated");
    });
}

