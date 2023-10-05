// alert('algo');

$("#turno").change( function() {
    listar();
});

$("#anio").change( function() {
    listar();
});

function listar() {
    let turno = $("#turno").val();
    let anio = $("#anio").val();

    if((turno!="")&&(anio!="")) {
        $("#estudiante").empty();
        $("#estudiante").append('<option value="0">Todo el grupo</option>');
        content = '';
        $.ajax({
            typo: 'get',
            url:  'models/estudiantes.php?' + 'turno=' + turno + '&anio=' + anio,
            data: null,
            dataType: 'json',
            success: function (datos) {
                // alert(datos);
                $.each(datos, function(i, v) { // indice, valor
                    linea = '<option value="' + datos[i].id_estudiante + '">' + datos[i].nom_estudiante + '</option>\n';
                    // alert(linea);
                    $("#estudiante").append(linea);
                });
            }
        });
    }
}

$("#clean").click( function(){
    $("#estudiante").empty();
    $("#estudiante").append('<option value="0">Todo el grupo</option>');
});