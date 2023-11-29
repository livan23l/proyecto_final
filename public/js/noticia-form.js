document.addEventListener('DOMContentLoaded', function () {
    var zona = document.getElementById('lista_zona');

    document.querySelectorAll('input[name="origen"]').forEach(function (radioButton) {
        radioButton.addEventListener('change', function () {
            if (this.value === 'Estatal') {
                zona.classList.remove("d-none");
            } else {
                zona.classList.add("d-none");
            }
        });
    });

    var quill = new Quill('#contenido_quill', {
        modules: {
            toolbar: [
                [{ 'font': [] }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'align': [] }],
                ['link', 'image', 'video'],
                ['clean'],
            ]
        },
        placeholder: 'Escribe tu noticia...',
        theme: 'snow'
    });


    quill.on('text-change', function () {
        var contenido = quill.root.innerHTML;
        document.getElementById('contenido').value = contenido;
    });


    var contenido = document.getElementById('contenido').value;

    quill.clipboard.dangerouslyPasteHTML(contenido);
});

// ------------------------------------ CATEGORÍAS ------------------------------------

var aplicadas = $('#categorias_seleccionadas');  // La vista de las categorías que ya seleccionó el usuario.
var sugerencias = $('#categorias_sugerencias');  // La vista de las categorías que puede elegir el usuario.

var select_js = [];  // Todas las que ha seleccionado el usuario guardas en js.
var select_html = $('#categ_select');  // Todas las que ha seleccionado el usuario guardas en html.

var disponible_js = [];  // Todas las categorías disponibles en js.
var disponible_html = $('#canteg_all');  // Todas las categorías disponibles en html.


function select_categories(cur_id, cur_nam) {

    // Agregar la categoría seleccionada a select_js
    select_js.push({
        id: cur_id,
        nombre: cur_nam
    });

    // Eliminar la categoría seleccionada de categorias
    select_html = select_html.filter(function (categoria) {
        return categoria.id !== cur_id;
    });

    // Eliminar la categoría seleccionada de categ_all
    var categ_all_val = $('#categ_all').val();

    var categ_all_arr = JSON.parse(categ_all_val);
    categ_all_arr = categ_all_arr.filter(function (categoria) {
        return categoria.id !== cur_id;
    });
    $('#categ_all').val(JSON.stringify(categ_all_arr));

    // Actualizamos los inputs:
    $('#categ_select').val(JSON.stringify(select_js));
    $('#categorias_insrt').val('');
    $('#categorias_sugerencias').empty();

    // Actualizamos el nombre en la lista:
    aplicadas.append('<li id="categoria_' + cur_id + '" class="list-group-item d-flex justify-content-between align-items-center">'
        + cur_nam +
        '<a role="button" class="text-danger" onclick="eliminarCategoriaSeleccionada(' + cur_id + ')"><i class="bi bi-trash">'
        + '</i></a></li><input type="checkbox" class="d-none" id="noticia_' + cur_id + '" name="categorias[]" value="' + cur_id + '" checked />');
}

function show_categories() {
    try {
        var categories = JSON.parse($('#categ_select').val());
        for (var i = 0; i < categories.length; i++) {
            var cur_id = categories[i]['id'];
            var cur_nam = categories[i]['nombre'];
            select_categories(cur_id, cur_nam);
        }
    } catch (error) {
        console.error("No categories");
    }
}

show_categories();


function eliminarCategoriaSeleccionada(id) {
    // Guardamos el elemento que se va a eliminar en eliminada:
    var eliminada = select_js.filter(function (categoria) {
        return categoria.id === id;
    });

    // Categorías seleccionadas
    select_js = select_js.filter(function (categoria) {  // Actualizamos las categorías seleccionadas en javascript:
        return categoria.id !== id;
    });
    select_html.val(JSON.stringify(select_js));  // Actualizamos las categorías seleccionadas en html:


    // Limpiar sugerencias
    sugerencias.empty();
    sugerencias.addClass('d-none');


    // Eliminar la categoría que acaba de eliminar el usuario de las que está viendo:
    $('#categoria_' + id).remove();


    disponible_js = JSON.parse($('#categ_all').val());  // Convertimos los disponibles de html a js
    disponible_js.push(eliminada[0]);  // Añadir la variable "eliminada" a la variable "disponible_js"
    $('#categ_all').val(JSON.stringify(disponible_js));  // Actualizamos las categorías disponibles en html

    // Actualizamos vistas con clases:
    $('#alert_categorias').addClass('d-none');
    $('#categorias_insrt').removeClass('d-none');
    $('#categorias_insrt_all').removeClass('d-none');
}

$(document).ready(function () {

    // Búsqueda de categorías:
    $('#categorias_insrt').on('input', function () {
        // Limpiar sugerencias anteriores:
        sugerencias.empty();

        // Verificar si se ha alcanzado el límite de categorías (5):
        if (select_js.length >= 5) {
            $('#alert_categorias').removeClass('d-none');
            $('#categorias_insrt').addClass('d-none');
            $('#categorias_insrt_all').addClass('d-none');
            return;
        }

        var condicion = $(this).val().toLowerCase();  // Condiciones para filtrar.

        disponible_js = JSON.parse($('#categ_all').val());  // Convertimos los disponibles de html a js

        // Filtramos en base a la condición anterior en todas las dispoibles de html
        var resultados = disponible_js.filter(function (categoria) {
            return categoria.nombre.toLowerCase().includes(condicion);
        });


        // Mostrar nuevas sugerencias
        resultados.forEach(function (categoria) {
            var sug_html = '<div class="sugerencia" data-id="' + categoria.id + '">' + categoria.nombre + '</div>';
            sugerencias.append(sug_html);
        });

        // Ajustar el ancho del contenedor:
        var input_width = $('#categorias_insrt').outerWidth();
        sugerencias.css('width', input_width);

        // Mostrar el select si hay sugerencias, ocultarlo si no hay ninguna:
        if (resultados.length > 0) {
            sugerencias.removeClass("d-none");
        } else {
            sugerencias.addClass("d-none");
        }
    });

    // Logica de la implementación:
    $(document).on('click', '.sugerencia', function () {
        var cur_id = $(this).data('id');
        var cur_nam = $(this).text();
        select_categories(cur_id, cur_nam);
    });
});

// Alerta
document.querySelector('.btn-close').addEventListener('click', function () {
    document.getElementById('alert_categorias').classList.add('d-none');
});