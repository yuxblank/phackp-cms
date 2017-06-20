<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="uk-panel uk-panel-box uk-width-1-1">
    <button class="uk-button uk-button-large uk-button-danger uk-button uk-align-right"
            onclick="window.location.replace('<?php echo yuxblank\phackp\core\Router::link('admin/logout') ?>')">
        <i class='uk-icon uk-icon uk-icon-power-off'></i> Esci</button>
    <h1 class="uk-panel-title"><i class='uk-icon uk-icon-large uk-icon-line-chart'></i>Statistiche cliente: <?php echo \controller\Secured::loadUser()->email ?></h1>
    <div class='uk-grid'>
        <div class='uk-width-1-1'>
            <table class="uk-table">
                <tr>
                    <th>#</th>
                    <th>Titolo</th>
                    <th>Clicks</th>
                    <th>Visulizzazioni</th>
                    <th>Attivo</th>
                    <th>Link</th>
                    <th>Immagine</th>
                </tr>
                <?php foreach ($banners as $key => $banner): ?>
                    <tr>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo $banner->title ?></td>
                        <td><?php echo $banner->clicks !== null ? $banner->clicks : 0 ?></td>
                        <td><?php echo $banner->views !== null ? $banner->views : 0 ?></td>
                        <td><?php echo $banner->getState() ?></td>
                        <td><a target="_blank" href="<?php echo $banner->url ?>"><i class="uk-icon-link"></i> <?php echo $banner->url ?></a></td>
                        <td><img src="<?php echo $banner->getImagePath() ?>" class="uk-thumbnail uk-thumbnail-mini"></td>


                    </tr>


                <?php endforeach;?>

            </table>

        </div>

    </div>
    <!--    <div class="uk-grid">-->
    <!--        <div class='uk-width-1-1'>-->
    <!--            <h3><i class='uk-icon uk-icon-large uk-icon-pie-chart'></i> Statistiche</h3>-->
    <!--            <ul class="uk-list uk-list-striped">-->
    <!--                <li>Attivi:</li>-->
    <!--            </ul>-->
    <!--        </div>-->
    <!---->
    <!--    </div>-->
    <!--    <div class="uk-grid">-->
    <!--        <div class='uk-width-1-1'>-->
    <!--            <h3><i class='uk-icon uk-icon-large uk-icon-calendar-check-o'></i> Ultime attività</h3>-->
    <!--            <ul class="uk-list uk-list-striped">-->
    <!--                <li>Attivi:</li>-->
    <!--            </ul>-->
    <!--        </div>-->
    <!--    </div>-->

</div>
</div>

