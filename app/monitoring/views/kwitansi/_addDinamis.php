<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 27-Oct-18
 * Time: 21:04
 */
?>
<script>
    $(document).ready(function(){
        var i=1;
        $('#add').click(function(){
            i++;
            $('#dynamic_field').append('' +
                '<tr id="row'+i+'">' +
                '<td><input type="text" name="KwiDes[]" placeholder="Deskripsi" class="form-control name_list" /></td>\n' +
                '<td><input type="text" name="KwiDur[]" placeholder="Durasi" class="form-control name_list" /></td>\n' +
                '<td><input type="text" name="KwiBya[]" placeholder="Biaya" class="form-control name_list" /></td>\n' +
                '<td><input type="text" name="KwiKet[]" placeholder="Keterangan" class="form-control name_list" /></td>'+
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
                '</tr>');
        });

        var j=1;
        $('#add2').click(function(){
            j++;
            $('#dynamic_field2').append('' +
                '<tr id="row'+j+'">' +
                '<td><input type="text" name="KwiDesRil[]" placeholder="Deskripsi" class="form-control name_list" /></td>\n' +
                '<td><input type="text" name="KwiDurRil[]" placeholder="Durasi" class="form-control name_list" /></td>\n' +
                '<td><input type="text" name="KwiByaRil[]" placeholder="Biaya" class="form-control name_list" /></td>\n' +
                '<td><button type="button" name="remove" id="'+j+'" class="btn btn-danger btn_remove">X</button></td>' +
                '</tr>');
        });
        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });

    });
</script>
