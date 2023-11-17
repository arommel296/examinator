window.addEventListener("load", function () {
    //Declaración de variables
    var cuerpo = document.getElementById("cuerpo");
    cuerpo.removeAttribute("class");
    cuerpo.classList.add("cuerpo3");
    var main = document.getElementsByTagName("main")[0];
    main.classList.add("cuerpo3");
    var btnComenzar = document.getElementById("comenzar");
    var divExamen = document.getElementById("examen");
    divExamen.classList.add("cuerpo2");
    var btnEliminar = document.getElementById("borrar");
    var btnSiguiente = document.getElementById("siguiente");
    var btnAnterior = document.getElementById("anterior");
    var btnEnviar = document.getElementById("enviar");

    //Borrado de la clase .ocultar para que se muestren los botones
    btnComenzar.removeAttribute("class");
    btnEnviar.removeAttribute("class");
    btnSiguiente.removeAttribute("class");
    btnAnterior.removeAttribute("class");
    btnEliminar.removeAttribute("class");
    //Dejamos ocultos los necesarios para que no se vean antes de que cargue el DOM
    btnEnviar.style.display = "none";
    btnSiguiente.style.display = "none";
    btnAnterior.style.display = "none";
    btnEliminar.style.display = "none";

    //Creación de cuadrados para las preguntas
    var divCuadrados=document.createElement("div");
    divCuadrados.id="cuadrados";
    divCuadrados.style.display="grid";
    divCuadrados.style.width="5em";
    divCuadrados.style.height="5em";
    divCuadrados.setAttribute("grid-template-columns", "repeat(5, 20%)");
    main.appendChild(divCuadrados);

    var pregActual;
    var numPreg;
    var respuestas=[];
    var preguntas;

    //Adición de eventos a los botones
    btnComenzar.addEventListener("click", comenzar);
    btnAnterior.addEventListener("click", antePreg);
    btnSiguiente.addEventListener("click", nuevaPreg);
    btnEnviar.addEventListener("click", enviarExamen);
    btnEliminar.addEventListener("click", borraRespuesta);

    //btnBorrar.addEventListener("click", borrar);


    //Función comenzar, hace lo siguiente:
    //Coge como texto plano la plantilla de una pregunta de un archivo html,
    //Hace una llamada AJAX para traer el intento
    //Función asíncrona, necesita cargarse antes de usarse
    async function comenzar() {
        const e = await fetch("./plantillas/preguntas.html")
        const a = await e.text()
        var contenedor = document.createElement("div");
        contenedor.innerHTML = a;
        var pregunta = contenedor.firstChild;
        // var checkbox = contenedor.getElementsByClassName("dudosa")[0];
        // checkbox.addEventListener("change", dudosa);

        const d = await fetch("http://localhost/DEWESE/examinator/api/ApiIntento.php", {
            method: "POST",
            body: JSON.stringify({
                "idIntento": 3 //se lo paso así por ahora para poder hacer el examen
            }), 
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        const y = await d.json()
        numPreg=y.length;
        console.log(y.length);
        for (let i = 0; i < y.length; i++) {
            var pos={id: y[i].id, respuesta: ""};
            var pregAux = pregunta.cloneNode(true);

            //Creación de los cuadrados para viajar a las preguntas
            var nuevoCuadrado=document.createElement("span");
            nuevoCuadrado.style.border="0.1em solid black";
            divCuadrados.appendChild(nuevoCuadrado);
            nuevoCuadrado.innerHTML=i+1;
            nuevoCuadrado.setAttribute("preg",i);
            nuevoCuadrado.addEventListener("click", visualizaPreg);
            //Creación del checkbox de dudosa
            var duda = document.createElement("span");
            duda.innerHTML="Dudosa";
            pregAux.appendChild(duda);
            var checkbox=document.createElement("input");
            checkbox.setAttribute("type", "checkbox");
            pregAux.appendChild(checkbox);
            checkbox.addEventListener("change", dudosa)

            console.log(pregAux);
            console.log(pregunta);
            pregAux.getElementsByClassName("numero")[0].innerHTML = i+1;
            console.log(y[i].enunciado);

            //Inserción de enunciados y respuestas
            pregAux.getElementsByClassName("descripcion")[0].innerHTML = y[i].enunciado;
            pregAux.getElementsByClassName("opcion1")[0].innerHTML = y[i].resp1;
            pregAux.getElementsByClassName("opcion2")[0].innerHTML = y[i].resp2;
            pregAux.getElementsByClassName("opcion3")[0].innerHTML = y[i].resp3;
            divExamen.appendChild(pregAux);
            var op = [y[i].resp1,y[i].resp2,y[i].resp3];
            var radios = pregAux.querySelectorAll('input[type="radio"]');
            console.log('Pregunta ' + i + ', radios.length: ' + radios.length);
            for (var j = 0; j < 3; j++) {
                radios[j].setAttribute("name", "respuesta" + i);
                radios[j].setAttribute("id", +3 * i + j + 1);
                radios[j].nextSibling.setAttribute("for", "respuesta" + i);
                radios[j].setAttribute("value",op[j]);
                //radios[j].classList.add("no-selec");
                console.log('Pregunta ' + i + ', radio ' + j + ', name: ' + radios[j].name + ', id: ' + radios[j].id);
            }
            pregAux.setAttribute("id", "preg-" + (i));
            // pregAux.setAttribute("id","preg-");
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

            // Escondo todas las preguntas menos la primera
            if (i != 0) {
                pregAux.style.display = "none";
            } 
            respuestas.push(pos);
        }
        // })
        console.log(divExamen);
        preguntas=divExamen.childNodes;
        //numPreg=preguntas.length-1;
        console.log(numPreg);
        pregActual=0;
        console.log(preguntas[pregActual]);
        // if (pregunta.previousElementSibling != null) {
        //     btnSiguiente.style.display = "";
        // }
        // if (pregunta.nextElementSibling != null) {
        //     btnAnterior.style.display = "";
        // }
        // if (pregunta.nextElementSibling == null) {
        //     btnEnviar.style.display = "";
        // }
        //btnSiguiente.style.display = "";
        btnComenzar.style.display = "none";
        btnEliminar.style.display = "";
        btnSiguiente.style.display = "";

    }

    function antePreg() {
        recogeRespuesta();
        preguntas[pregActual].style.display="none";
        preguntas[pregActual-1].style.display="";
        if ((pregActual-1)==0) {
            btnAnterior.style.display = "none";
        }
        if ((pregActual-1)<(numPreg)) {
            btnEnviar.style.display = "none";
            btnSiguiente.style.display = "";
        }
        pregActual--;
    }

    function nuevaPreg() {
        recogeRespuesta();
        preguntas[pregActual].style.display="none";
        preguntas[pregActual+1].style.display="";
        if ((pregActual+1)==(numPreg-1)) {
            btnSiguiente.style.display = "none";
            btnEnviar.style.display = "";
        }
        if (pregActual==0) {
            btnAnterior.style.display = "";
        }
        pregActual++;

    }

    function recogeRespuesta() {
        try {
            var valor=preguntas[pregActual].querySelector('input[name="respuesta'+pregActual+'"]:checked').value;
            respuestas[pregActual].respuesta=valor;
        } catch (error) {
            
        }
        console.log(respuestas);
    }

    function enviarExamen() {
        var intJson=JSON.stringify(preguntas);
        console.log(intJson);
        let datos={intJ: respuestas,
        idIntento:3};
        console.log(JSON.stringify(datos));
        fetch("http://localhost/DEWESE/examinator/api/ApiIntento.php", {
            method: "POST",
            body: JSON.stringify(datos),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(y => {
            return y.text();
        });

    }

    function visualizaPreg() {
        recogeRespuesta();
        divCuadrados.style.display="";
        //console.log(preguntas[pregActual]);
        preguntas[pregActual].style.display="none";
        //console.log(parseInt(this.getAttribute("preg")));
        var nPrg=parseInt(this.getAttribute("preg"));
        preguntas[nPrg].style.display="";
        //pregActual=this.id;
        if ((nPrg)==(0)) {
            btnAnterior.style.display = "none";
            btnSiguiente.style.display = "";
            btnEnviar.style.display="none";
        }
        if (nPrg>0 && nPrg<(numPreg-1)) {
            btnAnterior.style.display = "";
            btnSiguiente.style.display = "";
            btnEnviar.style.display="none";
        }
        if (nPrg==(numPreg-1)) {
            btnSiguiente.style.display = "none";
            btnEnviar.style.display="";
            btnAnterior.style.display = "";
        }
        pregActual=nPrg;
    }

    function borraRespuesta() {
        try {
            var valor=preguntas[pregActual].querySelector('input[name="respuesta'+pregActual+'"]:checked');
            console.log(valor);
            if (valor) {
                valor.checked=false;
            }
            recogeRespuesta();
        } catch (error) {
            
        }
    }

    function mezclaRespuestas(arrayResp) {
        for (let i = arrayResp.length - 1; i > 0; i--) {
            let j = Math.floor(Math.random() * (i + 1));
            [arrayResp[i], arrayResp[j]] = [arrayResp[j], arrayResp[i]];
        }
    }

    function dudosa() {
        if (this.checked) {
            console.log(divCuadrados.childNodes[pregActual]);
            divCuadrados.childNodes[pregActual].style.borderColor = "red";  
        } else {
            // Si el checkbox no está marcado, quita el color del borde
            divCuadrados.childNodes[pregActual].style.borderColor = "black";
        }
    }

})