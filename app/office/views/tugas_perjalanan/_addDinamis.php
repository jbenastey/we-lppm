<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 16-Oct-18
 * Time: 22:11
 */
?>

<script>
$(document).ready(function(){
    var i=1;
    $('#add4').click(function(){
        i++;
        $('#dynamic_field4').append('' +
            '<tr id="row'+i+'">' +
            '<td><input type="text" placeholder="Nama Anggota" class="form-control" name="StpAngNam[]" value="">'+
            '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
            '</tr>');
    });


    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
    });

});
</script>