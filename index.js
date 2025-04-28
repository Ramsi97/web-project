const works = ["SOftware Engineer", "Fullstack Developer", "Comptetive Programmer"];
const typingspeed =  100;
const deletingspeed = 50;

let isDeleting = false;
var i = 0;
var j = 0;

function type(){
    var currentstring = word[i];
    var displayedtext = currentstring.substring(0, j);

    document.getElementsByClassName(work).innerHTML = displayedtext;

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
            i = (i+1)%works.length;
            j -= 1;
            isDeleting = true;

        }
    }
}