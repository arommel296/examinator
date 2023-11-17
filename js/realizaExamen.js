//En este archivo js se produce la realización de un examen de la siguiente manera:
//Al pulsar en el botón comenzar se carga la plantilla html de una pregunta (llamada AJAX al servidor),
//tantas veces como preguntas tenga el examen.
//Se cargan las preguntas de la base de datos mediante una llamada AJAX al servidor y se introducen en el html
//Se generan tantos cuadrados como preguntas tenga el examen con el número de pregunta, para poder moverte más rápido
//a la pregunta deseada.
//Deja de mostrarse el botón comenzar, se muestra solo la primera pregunta y el botón de siguiente.

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

    //Más Variables de trabajo
    var pregActual; //Aquí se irá guardando la pregunta que se está visualizando
    var numPreg; //Número de preguntas que tiene el examen
    var respuestas=[]; //Array de datos en formato json
    var preguntas; //Colección de elementos html, contiene los divs de las preguntas

    //Adición de eventos a los botones
    btnComenzar.addEventListener("click", comenzar);
    btnAnterior.addEventListener("click", antePreg);
    btnSiguiente.addEventListener("click", nuevaPreg);
    btnEnviar.addEventListener("click", enviarExamen);
    btnEliminar.addEventListener("click", borraRespuesta);


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

            for (var j = 0; j < 3; j++) {
                radios[j].setAttribute("name", "respuesta" + i);
                radios[j].setAttribute("id", +3 * i + j + 1);
                radios[j].nextSibling.setAttribute("for", "respuesta" + i);
                radios[j].setAttribute("value",op[j]);
            }

            pregAux.setAttribute("id", "preg-" + (i));
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

        console.log(divExamen);
        preguntas=divExamen.childNodes;
        console.log(numPreg);
        pregActual=0;
        console.log(preguntas[pregActual]);

        btnComenzar.style.display = "none";
        btnEliminar.style.display = "";
        btnSiguiente.style.display = "";

    }


    //Función que esconde la pregunta actual y deja ver la pregunta anterior a la actual.
    //Si es la primera esconde los botones innecesarios y deja ver los necesarios
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

    //Función que esconde la pregunta actual y deja ver la pregunta siguiente a la actual.
    //Si es la primera esconde los botones innecesarios y deja ver los necesarios
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

    //Función que guarda la respuesta marcada por el usuario (en la pregunta actual) en el array de preguntas (contiene json)
    function recogeRespuesta() {
        try {
            var valor=preguntas[pregActual].querySelector('input[name="respuesta'+pregActual+'"]:checked').value;
            respuestas[pregActual].respuesta=valor;
        } catch (error) {
            
        }
        console.log(respuestas);
    }

    //Función que hace una llamada AJAX al servidor, actualizando el intento (introduce en la bdd el array de json respuestas)
    function enviarExamen() {
        var intJ=JSON.stringify(respuestas);
        console.log(intJ);
        let datos={intJson: respuestas,
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

    //Función que esconde la pregunta actual y deja ver la pregunta pulsada
    function visualizaPreg() {
        recogeRespuesta();
        divCuadrados.style.display="";

        preguntas[pregActual].style.display="none";

        var nPrg=parseInt(this.getAttribute("preg"));
        preguntas[nPrg].style.display="";

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

    //Función que cambia el color del borde del cuadrado que representa la pregunta con el checkbox de pregunta dudosa 
    //marcado
    function dudosa() {
        if (this.checked) {
            console.log(divCuadrados.childNodes[pregActual]);
            divCuadrados.childNodes[pregActual].style.borderColor = "red";  
        } else {
            // Si el checkbox no está marcado, vuelve a poner el borde en negro
            divCuadrados.childNodes[pregActual].style.borderColor = "black";
        }
    }

})