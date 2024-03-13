
var cont = 0;

function eliminar(eliminar) {
    let elemento = document.getElementById(eliminar);
    elemento.parentNode.removeChild(elemento);
}

$('.clonar').click(function () {
    // Clona el .input-group
    //let $clone = $('#formulario .input-group').last().clone();
    let form = document.getElementById('formulario');
    let arreglo = ['r_nombre[]', 'r_tipo[]'];

    var div = document.createElement("div");
    var span = document.createElement("span");
    span.className = "btn btn-danger";


    span.className = "btn btn-danger m-1 rounded-right";
    span.textContent = 'X';
    let numero = cont;
    span.addEventListener("click", function () {
        eliminar(numero)
    }, false);

    let status = ['Estatal', 'Nacional', 'Internacional', 'Otro'];

    arreglo.forEach(function (element) {


        if (element == 'r_tipo[]') {
            var input = document.createElement("select");
            input.name = element;
            input.className = "form-control col-md-3 m-1 rounded";
            input.setAttribute("id", 'r_tipo');
            div.appendChild(input);

            for (var i = 0; i < status.length; i++) {
                var option = document.createElement("option");
                option.value = status[i];
                option.text = status[i];
                input.appendChild(option);
            }

        } else {
            var input = document.createElement("input");
            input.type = "text";
            input.name = element;
            input.placeholder = "Nombre";
            input.className = "form-control col-md-3 m-1 rounded";
            input.setAttribute("id", 'r_nombre');

            div.appendChild(input);
        }
    });
    div.setAttribute('id', cont);
    div.className = 'input-group d-flex flex-wrap';
    cont = cont + 1;
    div.appendChild(span);
    form.appendChild(div);

});
