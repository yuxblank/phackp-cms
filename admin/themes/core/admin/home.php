<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="uk-panel uk-panel-box uk-width-1-1">

    <h1 class="uk-panel-title"><i class='uk-icon uk-icon-large uk-icon-dashboard'></i> Pannello di controllo</h1>
    <div class='uk-grid'>
        <div class='uk-width-4-10'>
            <h3><i class='uk-icon uk-icon-large uk-icon-edit'></i> Articoli</h3>

            <ul class="uk-list uk-list-striped">
                <li>Articoli: <?php echo $item->count(); ?> di cui
                    attivi <?php echo $item->countActive(); ?></li>

                <li>Categorie: <?php echo $category->count(); ?> </li>

            </ul>


        </div>
        <div class='uk-width-3-10'>
            <h3><i class='uk-icon uk-icon-large uk-icon-cube'></i> Banner</h3>
            <ul class="uk-list uk-list-striped">
                <li>Totali: <?php echo $banner->count() ?></li>
                <li>Attivi: <?php echo $banner->countActive() ?></li>
                <li>Click totali: <?php echo $banner->getTotalClicks()->totalclicks ?></li>
                <li>Viste totali: <?php echo $banner->getTotalViews()->totalviews ?></li>
            </ul>
        </div>
        <div class='uk-width-3-10'>
            <h3><i class='uk-icon uk-icon-large uk-icon-user'></i> Utenti</h3>
            <ul class="uk-list uk-list-striped">
                <li>Attivi: <?php echo $user->countActive() ?> </li>
                <li>Clienti:<?php echo $userRole->countCustomers() ?> </li>
            </ul>
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
