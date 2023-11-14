window.addEventListener("load", function () {
    var preguntas = document.getElementById("preguntas");

    async function refrescaPreguntas() {
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

                const d=await fetch("http://localhost/DEWESE/examinator/api/apiPregunta.php?menu=examenManual")
                    const a=await d.json()
                    for (let i = 0; i < a.length; i++) {
                        var nuevaPregunta = pregunta.cloneNode(true);
                        nuevaPregunta.querySelector(".usuario").innerHTML = a[i].nombre;
                        preguntas.appendChild(nuevaPregunta);
                    };
            })
            .catch(error => {
                console.error('Error al obtener plantilla de pregunta:', error);
            });
    }

    refrescaPreguntas();
});