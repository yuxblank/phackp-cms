<div class="uk-container-center">
    <div class="uk-slidenav-position" data-uk-slideshow="{kenburns:true}">
        <ul class="uk-slideshow">
            <?php foreach ($_slideshowImages as $image): ?>
                <li> <img class="" style="max-height: 300px;" src="<?php echo yuxblank\phackp\core\Application::getAppUrl()."/public/images/home_slider/$image"?>"></li>
            <?php endforeach; ?>
        </ul>
        <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
        <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>

        <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
            <?php foreach ($_slideshowImages as $key => $value):?>
                <li data-uk-slideshow-item="<?php echo $key ?>"><a href="#"></a></li>
            <?php endforeach;?>

        </ul>
    </div>

</div>

