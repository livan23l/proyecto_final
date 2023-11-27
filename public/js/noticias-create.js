document.addEventListener('DOMContentLoaded', function () {
    var zona = document.getElementById('lista_zona');

    document.querySelectorAll('input[name="alcance"]').forEach(function (radioButton) {
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