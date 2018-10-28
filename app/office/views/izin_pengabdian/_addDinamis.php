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
        $('#add3').click(function(){
            i++;
            $('#dynamic_field3').append('' +
                '<tr id="row'+i+'">' +
                '<td><input type="text" placeholder="Nama Anggota" class="form-control" name="SipAngNam[]" value="" autocomplete="off"></td>'+
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
                '</tr>');
        });


        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });

    });
</script>