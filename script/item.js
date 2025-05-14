let arr = []
const numberOfProduct  = document.querySelector(".numberOfProduct");

if (localStorage.getItem("products") == "[]"){
    cards.innerHTML = `
        <h1 class="noItem"> No Item To Show </h1>
    `
}else{
    if (localStorage.getItem("products") != null  ){
        let array=JSON.parse(localStorage.getItem("products"))
        arr=array.map((el)=>{
            return el;
        })
    }
}


numberOfProduct.innerHTML = arr.length;