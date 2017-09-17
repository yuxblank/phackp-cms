<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 class="uk-panel-title"><i class='uk-icon uk-icon-large uk-icon-user'></i> Elenco utenti</h1>
<table class='uk-table'>
    <thead>
    <th>#</th>
    <th>Email</th>
    <th>Ruolo</th>
    <th>Data creazione</th>
    <th>Stato</th>
    </thead>
    <tbody>

    <?php
    /** @var \cms\doctrine\model\User $user */
    foreach ($users as $user) { ?>
        <tr>
            <td><input type="checkbox" name='ids[]' value="<?php echo $user->getId() ?>"></td>
            <td>
                <a href="<?php echo $this->router->link('admin/user/edit/{id}', [$user->getId()]) ?>"><?php echo $user->getUsername() ?></a>
            </td>
            <td><?php echo $user->getRole()->getTitle() ?></td>
            <td><?php echo $user->getDateUpdated()->format('d-m-Y H:i') ?></td>
            <td><?php echo $user->getStatus() ?></td>

        </tr>


    <?php } ?>


    </tbody>


</table>

<script>
    $('#yx-delete-btn').on('click', function () {
        var num = $("input:checked").length;
        if (num > 0) {
            ids = $('input:checked');
            content = "La cancellazione é irreversibile, gli elementi cancellati non potranno essere ripristinati in seguito. Procedere?";
            UIkit.modal.confirm(content, function () {
                var request = $.ajax({
                    url: "<?php echo $this->router->link('admin/user/delete') ?>",
                    type: "POST",
                    data: ids
                });
                request.done(function (data) {
                    UIkit.modal.confirm("Eliminati " + data + " elementi", function () {
                        location.reload();
                    });
                });
            });
        } else {
            UIkit.modal.alert("Devi selezionare almeno un elemento!");
        }
    });
</script>

