<?phpuse yuxblank\phackp\core\Router;?><h1 class="uk-panel-title"><i class='uk-icon uk-icon-large uk-icon-edit'></i> Elenco categorie</h1><?php/* * To change this license header, choose License Headers in Project Properties. * To change this template file, choose Tools | Templates * and open the template in the editor. */?><table class='uk-table'>    <thead>        <th>#</th>        <th>Titolo</th>        <th>Descrizione</th>        <th>Articoli</th>    </thead>    <tbody>        <?php        foreach ($categories as $category) { ?>        <tr>            <td><input type='checkbox' value='<?php echo $category->getId() ?>' name='ids[]'></td>            <td><a href="<?php echo $this->router->link('admin/category/edit/{id}',[$category->getId()]);?>"><i class="uk-icon uk-icon-small uk-icon-hover uk-icon-edit"></i><?php echo $category->getTitle() ?></a></td>            <td><?php echo htmlspecialchars_decode($category->getContent()); ?></td>            <!--<td><a href="<?php echo $this->router->link("Admin@filterItemsByCat", ['id' => $category->getId()]); ?>"><i class="uk-icon uk-icon-medium uk-icon-search-plus"></i></a></td> -->        </tr>        <?php } ?>    </tbody></table><script>    $('#yx-delete-btn').on('click', function(){        var num = $( "input:checked" ).length;        if (num>0) {            ids = $('input:checked');            content = "La cancellazione � irreversibile, gli elementi cancellati non potranno essere ripristinati in seguito. Procedere?";            UIkit.modal.confirm(content, function(){                $.post('<?php echo $this->router->link('admin/categories/delete');?>',ids);            });        } else {            UIkit.modal.alert("Devi selezionare almeno un elemento!");        }    });</script>