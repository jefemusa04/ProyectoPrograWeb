document.addEventListener("DOMContentLoaded", function (){
let sliderInner = document.querySelector(".slider-inner");

let imagenes = sliderInner.querySelectorAll("img");
let index = 1;

setInterval(function(){
    let porcentaje = index * -100;
sliderInner.style.transform = "translateX("+ porcentaje +"%)";
index++;
if(index > (imagenes.length - 1)){
    index = 0;
}
}, 6000);
});