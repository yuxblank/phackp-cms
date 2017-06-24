<?php
use yuxblank\phackp\core\Application;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="<?php echo $APP_URL ?>/admin/themes/core/css/uikit.gradient.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo $APP_URL ?>/admin/themes/core/css/components/form-select.gradient.min.css"
          rel="stylesheet" type="text/css">
    <link href="<?php echo $APP_URL ?>/admin/themes/core/css/components/form-advanced.gradient.min.css"
          rel="stylesheet" type="text/css">
    <link href="<?php echo $APP_URL ?>/admin/themes/core/css/components/notify.css" rel="stylesheet"
          type="text/css">
    <link href="<?php echo $APP_URL ?>/admin/themes/core/css/components/placeholder.gradient.css"
          type="text/css" rel="stylesheet">
    <script src="<?php echo $APP_URL ?>/admin/themes/core/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo $APP_URL ?>/admin/themes/core/js/uikit.js"></script>
    <script src="<?php echo $APP_URL ?>/admin/themes/core/js/components/notify.js"></script>
    <script src="<?php echo $APP_URL ?>/admin/themes/core/js/components/form-select.min.js"></script>
    <?php
    // support for includes;
    if (isset($includes)) {
        echo $includes;
    } ?>

</head>
<body>
<?php //if (isset($adminMenu)): include Application::getViewRoot().'/admin/includes/main-menu.php'; endif; ?>
<div class='main-container uk-container uk-container-center uk-clearfix'>


    <?php
    if (isset($adminMenu)): ?>
        <a href="#offcanvas" class="uk-navbar-toggle " data-uk-offcanvas></a>
    <?php endif; ?>
    <div class="uk-navbar-brand uk-navbar-center ">AppKit</div>

    <div class='uk-container uk-container-center'>
        <div class="uk-width-1-1 uk-margin">
            <?php if (isset($controlHeader)) { ?>

            <div class="uk-grid">
                <div class="uk-width-small-6-10 uk-width-medium-7-10 uk-width-large-8-10 uk-grid-width-xlarge-8-10 ">

                </div>
                <div class="uk-width-small-4-10 uk-width-medium-3-10 uk-width-large-2-10 ">
                    <?php if (isset($controlHeader->delete)) { ?>
                        <button type="button" id="yx-delete-btn" class="uk-button  uk-button-danger">Cancella</button>
                    <?php } ?>
                    <?php if (isset($controlHeader->new)) { ?>
                        <a href="<?php echo $controlHeader->new ?>" class="uk-button  uk-button-primary">Nuovo</a>
                    <?php } ?>
                    <?php if (isset($controlHeader->save)) { ?>
                        <button type="button" id="yx-save-btn" class="uk-button  uk-button-success">Salva</button>
                    <?php } ?>
                </div>
            </div>

        </div>


    </div>

<?php } ?>







    <?php $this->content() ?>


    <div id="offcanvas" class="uk-offcanvas">
        <?php
        if (isset($adminMenu)):
            include_once __DIR__ . '/includes/main-menu-offcanvas.php';
        endif;
        ?>

    </div>

    <footer class="uk-block uk-text-center">
        <p>
            &copy; Yuri Blanc <br>
            <a target="_blank" href="www.yuriblanc.it">www.yuriblanc.it</a>

        </p>

    </footer>


</div>


</body>
<script>

    <?php
    $notify = array();
    if (isset($_COOKIE['warning'])) {
        array_push($notify, $_COOKIE['warning']);
    }
    if (isset($_COOKIE['danger'])) {
        array_push($notify, $_COOKIE['danger']);
    }
    if (isset($_COOKIE['success'])) {
        array_push($notify, $_COOKIE['success']);
    }
    foreach ($notify as $push) { ?>

    UIkit.notify({
        message: '<?php echo $push ?>',
        status: 'success',
        timeout: 5000,
        pos: 'bottom-right'
    });


    <?php } ?>

</script>

</html>
