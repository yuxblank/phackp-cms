 <div class="uk-panel uk-panel-box uk-panel-box-primary">        <div class="uk-panel-header">        <h3 class="uk-panel-title">I nostri partner</h3>        </div>        <div class="uk-grid uk-grid-width-medium-1-3 uk-grid-divider" data-uk-margin>            <?php foreach ($_banners as $banner): ?>                    <a class="banner" href="<?php echo $this->router->link('banner/{id}', array($banner->id)); ?>"><img                            src="<?php echo \yuxblank\phackp\core\Application::$ROOT. "/public/images/banners/" . $banner->image ?>"></a>                    <?php                    $banner->view();                ?>            <?php endforeach; ?>        </div>    </div>