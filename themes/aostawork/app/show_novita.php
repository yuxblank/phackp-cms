<?php
/**
 * Created by PhpStorm.
 * User: TheCo
 * Date: 26/12/2015
 * Time: 19:53
 */



?>


<div>

        <article class="uk-article uk-panel uk-panel-box uk-panel-box-primary">

            <div class="item-title uk-panel-header">
                <h3 class="uk-panel-title"><?php echo $item->title?></h3>
            </div>
            <div class="item-content">
                <p><?php echo htmlspecialchars_decode($item->content) ?></p>
            </div>


        </article>



</div>
