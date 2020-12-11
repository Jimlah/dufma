let btn = document.querySelector("#slide_left_btn");
let overlapHeader = document.querySelector("#page-wrapper > div > div > div > div.col-lg-3.col-md-12.col-sm-12.right-details.fluid > div.ongoing_inv > div");
let investmentList = document.querySelectorAll('.list-investments li');
let searchBox = document.querySelector("#page-wrapper > div > div > div > div.col-lg-3.col-md-12.col-sm-12.right-details.fluid > div.ongoing_inv > div > div > input[type=text]");

function filterInvestments(){
    let query = searchBox.value.toLowerCase();
    console.log(query);
    for(i=0;i < investmentList.length;i++){
        if (investmentList[i].innerText.indexOf(query) >-1){
            investmentList[i].style.display = 'flex';
            console.log('found');
        }else{
            investmentList[i].style.display = 'none';
        }
    }
}


btn.addEventListener('click',() => {
    overlapHeader.classList.toggle('column-flexed');
})

