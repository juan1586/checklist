$(function(){

    $("#departamento").on('change',onSelectProjectChange);

})

function onSelectProjectChange(){
    var departamento_id = $(this).val();

    $.get('/api/auth/register/'+departamento_id+'/municipios',function (data){
        var html_select = '<option value="">Seleccione Municipio</option>';
        for(var i=0; i<data.length; i++){
            html_select += '<option value="'+data[i].mun_codigo+'">'+data[i].mun_nombre+'</option>' ;

            $('#municipio').html(html_select);
        }
    })
}

$(function(){

    $("#municipio").on('change',onSelectProjectChangee);

})

function onSelectProjectChangee(){
    var municipio_id = $(this).val();

    $.get('/api/auth/register/'+municipio_id+'/tiendas',function (data){
        var html_select = '<option value="">Seleccione Tienda</option>';
        for(var i=0; i<data.length; i++){
            html_select += '<option value="'+data[i].tieCodigo+'">'+data[i].tieNombre+'</option>' ;

            $('#tienda').html(html_select);
        }
    })
}