window.addEventListener("load", function () {
    var alumnos = document.getElementById("alumnos");

    async function refrescaAlumnos() {
        while (alumnos.firstChild) {
            alumnos.removeChild(alumnos.firstChild);
        }

        fetch("http://localhost/DEWESE/examinator/plantillas/alumno.html")
            .then(x => x.text())
            .then(async y => {
                var contenedor = document.createElement("div");
                contenedor.innerHTML = y;
                var alumno = contenedor.firstChild;

                const d=await fetch("http://localhost/DEWESE/examinator/api/apiAlumno.php?menu=examinar")
                    const a=await d.json()
                    for (let i = 0; i < a.length; i++) {
                        console.log(a[i].nombre);
                                    var nuevoAlumno = alumno.cloneNode(true);
                                    nuevoAlumno.querySelector(".usuario").innerHTML = a[i].nombre;
                                    alumnos.appendChild(nuevoAlumno);
                                };

            })
            .catch(error => {
                console.error('Error al obtener plantilla de alumno:', error);
            });
    }

    refrescaAlumnos();
});
