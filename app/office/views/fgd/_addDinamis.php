<?php
/**
 * Created by PhpStorm.
 * User: IF hw2e
 * Date: 16/10/2018
 * Time: 0:56
 */
?>
<script>
    $(document).ready(function(){
        var i=1;
        $('#add1').click(function(){
            i++;
            $('#dynamic_field1').append('' +
                '<tr id="row'+i+'">' +
                '<td><input type="text" placeholder="Nama Peserta" class="form-control" name="FgdPesNam[]" value=""></td>'+
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
                '</tr>');
        });


        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });

    });
</script>