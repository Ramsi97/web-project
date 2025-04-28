

const works = ["Software Engineer", "Fullstack Developer", "Comptetive Programmer"];
const typingspeed =  300;
const deletingspeed = 200;
const pauseTime = 10000;

let isDeleting = false;
var i = 0;
var j = 0;

function type(){
    var currentstring = works[i];
    var displayedtext = currentstring.substring(0, j);

    document.getElementById("work").textContent = displayedtext;

    if(!isDeleting && j < currentstring.length){
        j++;
        setTimeout(type, typingspeed);
    }
    else if(isDeleting && j > 0){
        j--;
        setTimeout(type, deletingspeed)
    }
    else{
        if (!isDeleting){

            setTimeout(() => {
                isDeleting = true;
                setTimeout(type, deletingspeed);
            }, pauseTime);
            
        }
        else{
            isDeleting = false;
            i = (i+1)%works.length;
            setTimeout(type, typingspeed);
        }
    }
}

type()

var button = document.getElementById("abc")
button.addEventListener("click", function(){
    window.location.href = ("example.html")
})

var col = document.getElementsByClassName("colab")[0]

col.addEventListener("click", function(){
    window.location.href = ("example.html")
});