<?php
use yuxblank\phackp\core\Router;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 class="uk-panel-title"><i class='uk-icon uk-icon-large uk-icon-edit'></i> Elenco Banner</h1>
<table class='uk-table'>
    <thead>
    <th>#</th>
    <th>Title</th>
    <th>Cliente</th>
    <th>Click</th>
    <th>Immagine</th>
    <th>Stato</th>
    </thead>
    <tbody>

    <?php foreach ($banners as $banner) { ?>
        <tr>
            <td><input type="checkbox" name="ids[]" value="<?php echo $banner->id ?>"></td>
            <td>
                <a href="<?php echo $this->router->link('admin/banner/edit/{id}',array($banner->id)); ?>"><?php echo $banner->title ?></a>
            </td>
            <td><?php echo $banner->user()->email ?></td>
            <td><?php echo $banner->clicks ?></td>
            <td><img style="display: block; width: 20%"
                     src="<?php echo $APP_URL. "/public/images/banners/" . $banner->image ?>"></td>
            <td><?php echo $banner->getState()?></td>
        </tr>


    <?php } ?>


    </tbody>


</table>

<script>
    $('#yx-delete-btn').on('click', function(){
        var num = $( "input:checked" ).length;
        if (num>0) {
            ids = $('input:checked');
            content = "La cancellazione é irreversibile, gli elementi cancellati non potranno essere ripristinati in seguito. Procedere?";
            UIkit.modal.confirm(content, function(){
                var request = $.ajax({
                    url: "<?php echo $this->router->link('admin/banner/delete') ?>",
                    type: "POST",
                    data: ids
                });
                request.done(function(data){
                    UIkit.modal.confirm("Eliminati " + data + " elementi", function(){
                       location.reload();
                    });
                });
            });
        } else {
            UIkit.modal.alert("Devi selezionare almeno un elemento!");
        }
    });
</script>
