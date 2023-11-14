var btnComenzar = document.getElementById("comenzar");
    var divExamen = document.getElementById("examen");
    var btnEliminar = document.getElementById("borrar");
    var btnSiguiente = document.getElementById("siguiente");
    var btnAnterior = document.getElementById("anterior");
    var btnEnviar = document.querySelector('input[type="submit"]');
    btnEnviar.style.display="none";
    btnSiguiente.style.display="none";
    btnAnterior.style.display="none";

    btnComenzar.addEventListener("click", comenzar);
    btnAnterior.addEventListener("click", antePreg);
    btnSiguiente.addEventListener("click", nuevaPreg);

    //btnBorrar.addEventListener("click", borrar);

    function comenzar() {
        fetch("plantillas/pregunta.html")
            .then(x => x.text())
            .then(y => {
                var contenedor = document.createElement("div");
                // contenedor.class="pregunta";
                // contenedor.method="post";
                contenedor.innerHTML = y;
                var pregunta = contenedor.firstChild;

                fetch("servidor/preguntas.json")
                    .then(x => x.json())
                    .then(y => {
                        maxPreg=y.length;
                        for (let i = 0; i < maxPreg; i++) {
                            var pregAux = pregunta.cloneNode(true);
                            console.log(pregAux);
                            console.log(pregunta);
                            pregAux.getElementsByClassName("numero")[0].innerHTML = y[i].numero;
                            pregAux.getElementsByClassName("categoria")[0].innerHTML = y[i].categoria;
                            pregAux.getElementsByClassName("descripcion")[0].innerHTML = y[i].descripcion;
                            pregAux.getElementsByClassName("opcion1")[0].innerHTML = y[i].opcion1;
                            pregAux.getElementsByClassName("opcion2")[0].innerHTML = y[i].opcion2;
                            pregAux.getElementsByClassName("opcion3")[0].innerHTML = y[i].opcion3;
                            divExamen.appendChild(pregAux);
                            var radios = pregAux.querySelectorAll('input[type="radio"]');
                            console.log('Pregunta ' + i + ', radios.length: ' + radios.length);
                            for (var j = 0; j < 3; j++) {
                                    radios[j].setAttribute("name","respuesta"+i);
                                    radios[j].setAttribute("id",+3*i+j+1);
                                    //radios[j].classList.add("no-selec");
                                    console.log('Pregunta ' + i + ', radio ' + j + ', name: ' + radios[j].name+', id: ' + radios[j].id);
                            }
                            //pregAux.setAttribute("id","preg-"+i+1);
                            pregAux.setAttribute("id","preg-");
                            var recurso = pregAux.getElementsByClassName("recurso")[0];
                            var img = document.createElement("img");
                            var video = document.createElement("video");
                            var url = y[i].url;
                            if (y[i].tipo == "image") {
                                img.setAttribute("src", url);
                                recurso.appendChild(img);
                            } else {
                                video.setAttribute("src", url);
                                recurso.appendChild(video);
                            }
                            pregAux.getElementsByClassName("borrar")[0].onclick = function () {
                                var auxPadre = this;
                                console.log(auxPadre);
                                while (!auxPadre.classList.contains("pregunta")) {
                                    auxPadre = auxPadre.parentNode;
                                }
                                pregAux.getElementsByClassName("dudosa")[0].check = false;
                            }

                            // Escondo todas las preguntas menos la primera
                            if (i!=0) {
                                pregAux.style.display="none";
                            } else{
                                pregAux.setAttribute("id","preg-1");
                            }
                            
                        }
                    })
                btnSiguiente.style.display = "";
            })
        btnComenzar.style.display = "none";
        
    }