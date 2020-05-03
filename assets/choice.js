// choice.js


function vocajs(self){
    var findUl = document.getElementById('vocabularyList');
    var findLi = findUl.children;

    for (var i = 0; i < findLi.length; i++){
        if(findLi[i].id != self){
            findLi[i].classList.remove("is-none");
            findLi[i].classList.add("is-hide");
        }else{
            findLi[i].classList.remove("is-hide");
            findLi[i].classList.add("is-none");
        }
    }
}

function alls(){
    var findUl = document.getElementById('vocabularyList');
    var findLi = findUl.children;
    for (var i = 0; i < findLi.length; i++){
        findLi[i].classList.remove("is-hide");
        findLi[i].classList.add("is-none");
        }
}