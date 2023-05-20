

/*Comentarios*/

function comments(){
    let li = document.createElement("li");
    let valorIngresado = document.getElementById("newComment").value;
    let text = document.createTextNode(valorIngresado);
    li.appendChild(text);

    if(valorIngresado === ''){
        alert("Su comentario está vacío")
    }else{
        document.getElementById("comments").appendChild(li);
    }

    document.getElementById("newComment").value="";
    li.className = "comment";

    let borrar = document.createElement("p");
    borrar.innerHTML = ("Eliminar");
    borrar.className = "close";
    li.appendChild(borrar);

    let close = document.getElementsByClassName("close");
    let i;
    for(i=0; i<close.length; i++){
        close[i].onclick = function(){
            let div = this.parentElement;
            div.style.display = "none";
        }
    }
}