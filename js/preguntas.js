function cargaPregunta(pregunta) {
    var formulario = document.getElementById("nuevaPregunta");
    formulario.querySelector("#idPreg").value = pregunta.id;
    formulario.querySelector("#enunciado").value = pregunta.enunciado;
    formulario.querySelector("#resp1").value = pregunta.resp1;
    formulario.querySelector("#resp2").value = pregunta.resp2;
    formulario.querySelector("#resp3").value = pregunta.resp3;
    var categorias=formulario.querySelector("#categoria").value = pregunta.id_cat;
    var dificultades=formulario.querySelector("#dificultad").value = pregunta.id_dif;
    var respuestas=[pregunta.resp1,pregunta.resp2, pregunta.resp3];
    var ids=["#op1","#op2","#op3"];

    for (let i = 0; i < respuestas.length; i++) {
        formulario.querySelector(ids[i]).text=respuestas[i];
        formulario.querySelector(ids[i]).value=respuestas[i];
        if (respuestas[i]==pregunta.correcta) {
            console.log(respuestas[i], pregunta.correcta)
            formulario.querySelector(ids[i]).selected=true;
        }
    }
    // formulario.querySelector("#correcta").selected = pregunta.correcta;
    formulario.querySelector("#url").value = pregunta.url;
    formulario.querySelector("#tipoUrl").value = pregunta.tipoUrl;
}

function rellenaPregunta() {
    var formulario = document.getElementById("nuevaPregunta");
    var resp1=formulario.querySelector("#resp1");
    var resp2=formulario.querySelector("#resp2");
    var resp3=formulario.querySelector("#resp3");
    resp1.addEventListener("change", (ev) => rellenaSelect(ev, "#op1"));
    resp2.addEventListener("change", (ev) => rellenaSelect(ev, "#op2"));
    resp3.addEventListener("change", (ev) => rellenaSelect(ev, "#op3"));
}

function rellenaSelect(evento, resp){
    evento.preventDefault();
    var formulario = document.getElementById("nuevaPregunta");
    formulario.querySelector(resp).text=evento.target.value;
    formulario.querySelector(resp).value=evento.target.value;
}

function limpiaPregunta() {
    var formulario = document.getElementById("nuevaPregunta");
    formulario.querySelector("#enunciado").value = "";
    formulario.querySelector("#resp1").value = "";
    formulario.querySelector("#resp2").value = "";
    formulario.querySelector("#resp3").value = "";
    formulario.querySelector("#correcta").value = "";
    formulario.querySelector("#url").value = "";
    formulario.querySelector("#tipoUrl").value = "";
    formulario.querySelector("#categoria").value = "";
    formulario.querySelector("#dificultad").value = "";
}

function borraPregunta() {
    var formulario = document.getElementById("nuevaPregunta");
    var idPreg=formulario.querySelector("#idPreg").value;
    console.log(idPreg);
    fetch("http://localhost/DEWESE/examinator/api/ApiPregunta.php?id="+idPreg, {
            method: "DELETE"
        })
        .then(x => x.text())
        .then(y => {
            console.log(y);
            refrescaPreguntas();
            console.log("pregunta borrada");

        }); 
        limpiaPregunta();
}

function guardaPregunta() {
    var formulario = document.getElementById("nuevaPregunta");
    var idPreg=formulario.querySelector("#idPreg");
    var enunciado=formulario.querySelector("#enunciado");
    var resp1=formulario.querySelector("#resp1");
    var resp2=formulario.querySelector("#resp2");
    var resp3=formulario.querySelector("#resp3");
    var correcta=formulario.querySelector("#correcta");
    var categoria=formulario.querySelector("#categoria");
    var dificultad=formulario.querySelector("#dificultad");
    var url=formulario.querySelector("#url");
    var tipoUrl=formulario.querySelector("#tipoUrl");
    var preg;
    if (idPreg.value!="") {
        preg={
            "id": idPreg.value,
            "enunciado": enunciado.value,
            "resp1": resp1.value,
            "resp2": resp2.value,
            "resp3": resp3.value,
            "correcta": correcta.value,
            "id_cat": categoria.value,
            "id_dif": dificultad.value,
            "url": url.value,
            "tipoUrl": tipoUrl.value
        };
    } else {
        preg={
        "enunciado": enunciado.value,
        "resp1": resp1.value,
        "resp2": resp2.value,
        "resp3": resp3.value,
        "correcta": correcta.value,
        "id_cat": categoria.value,
        "id_dif": dificultad.value,
        "url": url.value,
        "tipoUrl": tipoUrl.value
        };
    }
    pregJson=JSON.stringify(preg);
    console.log(pregJson);
    fetch("http://localhost/DEWESE/examinator/api/ApiPregunta.php", {
            method: "POST",
            body: pregJson,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(y => {
    
            refrescaPreguntas();
            console.log("pregunta guardada");

        });

        limpiaPregunta();
        // refrescaPreguntas();
}


async function refrescaPreguntas() {
    var preguntas = document.getElementById("preguntas");
    while (preguntas.firstChild) {
        preguntas.removeChild(preguntas.firstChild);
    }

    fetch("http://localhost/DEWESE/examinator/plantillas/pregunta.html")
        .then(x => x.text())
        .then(async y => {
            console.log(y)
            var contenedor = document.createElement("div");
            contenedor.innerHTML = y;
            var pregunta = contenedor.firstChild;

            const d=await fetch("http://localhost/DEWESE/examinator/api/ApiPregunta.php?menu=examenManual")
                const a=await d.json()
                for (let i = 0; i < a.length; i++) {
                    var nuevaPregunta = pregunta.cloneNode(true);
                    nuevaPregunta.querySelector(".enunciado").innerHTML = a[i].enunciado;
                    
                    nuevaPregunta.addEventListener('click', function() {
                        cargaPregunta(a[i]);
                    });
                    preguntas.appendChild(nuevaPregunta);
                };
        })
        .catch(error => {
            console.error('Error al obtener plantilla de pregunta:', error);
        });
}

async function refrescaCategorias() {
    var categorias = document.getElementById("categoria");
    const d=await fetch("http://localhost/DEWESE/examinator/api/apiCategoria.php?menu=examinar")
        const a=await d.json()
            for (let i = 0; i < a.length; i++) {
                var option = document.createElement("option");
                console.log(a[i]);
                option.value = a[i].id;  
                option.text = a[i].nombreCat;
                categorias.add(option);
            };
}

async function refrescaDificultades() {
    var dificultades = document.getElementById("dificultad");
    const d=await fetch("http://localhost/DEWESE/examinator/api/ApiDificultad.php?menu=examinar")
        const a=await d.json()
            for (let i = 0; i < a.length; i++) {
                var option = document.createElement("option");
                console.log(a[i]);
                option.value = a[i].id;  
                option.text = a[i].nombre;
                dificultades.add(option);
            };
}