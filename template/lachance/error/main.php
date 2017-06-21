<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="<?php echo $APP_URL ?>/resource/lachance/css/uikit.gradient.min.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo $APP_URL ?>/resource/lachance/css/lachance.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo $APP_URL ?>/resource/lachance/css/components/slideshow.min.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo $APP_URL ?>/resource/lachance/css/components/dotnav.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo $APP_URL ?>/resource/lachance/css/components/slidenav.min.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo $APP_URL ?>/resource/lachance/css/components/notify.min.css" rel="stylesheet"
          type="text/css">
    <script src="<?php echo $APP_URL ?>/resource/lachance/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo $APP_URL ?>/resource/lachance/js/uikit.min.js"></script>
    <script src="<?php echo $APP_URL ?>/resource/lachance/js/components/slideshow.min.js"></script>
    <script src="<?php echo $APP_URL ?>/resource/lachance/js/components/pagination.min.js"></script>
    <script src="<?php echo $APP_URL ?>/resource/lachance/js/components/notify.min.js"></script>
    <script src="<?php echo $APP_URL ?>/resource/lachance/js/components/lightbox.min.js"></script>
    <script src="<?php echo $APP_URL ?>/resource/lachance/js/components/grid.min.js"></script>
</head>
<body>
<div class="uk-container uk-container-center uk-animation uk-animation-shake">

    <div class="yx-errorcontainer uk-container uk-container-center uk-margin-bottom" data-uk-margin>

        <div class="yx-page-content uk-margin uk-margin-large-top uk-text-center">
            <a href="<?php echo $APP_URL ?> "><img
                        src="<?php echo $APP_URL . "/resource/lachance/images/logo.png"; ?>"></a>
            <?php $this->content(); ?>
        </div>

    </div>
    <footer class="yx-footer">
        <div class="uk-container-center uk-text-center">
            <p>Webdesign & Development by Yuri Blanc</p>

            <p><a href="http://www.yuriblanc.it">www.yuriblanc.it</a></p>
        </div>

    </footer>


</div>
</body>
</html>
