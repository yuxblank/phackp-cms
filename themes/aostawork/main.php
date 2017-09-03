<?php
use yuxblank\phackp\core\Application;
use yuxblank\phackp\core\Router;
use yuxblank\phackp\core\View;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php
        if (isset($meta_title)) {
            echo $meta_title;
        } else {
            echo "Pizzeria La Chance";
        }
        ?>
    </title>
    <meta name="description" content="
    <?php
    if (isset($meta_description) && !empty($meta_description)) {
        echo $meta_description;
    } else {
        echo "Pizzeria d'asporto nei pressi di Aosta, vieni a scoprirci!";
    }
    ?>">
    <meta name="keywords" content="
    <?php

    if (isset($meta_tags) && !empty($meta_description)) {
        echo $meta_tags;
    } else {
        echo "pizzeria d'asporto, pizza aporto, pizzeria aosta, pizzerie aosta";
    }
    ?>">

    <link href="<?php echo $APP_URL ?>/themes/aostawork/resources/css/aostawork.css" rel="stylesheet"
          type="text/css">

    <link href="<?php echo $APP_URL; ?>/resource/lachance/css/jquery.cookiebar.min.css" rel="stylesheet"
          type="text/css">

    <link rel="apple-touch-icon" sizes="57x57"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo $APP_URL; ?>/resource/lachance/images/icon/manifest.json">
    <meta name="msapplication-TileColor" content="#4d984c">
    <meta name="msapplication-TileImage"
          content="<?php echo $APP_URL; ?>/resource/lachance/images/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#4d984c">


    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="<?php echo $APP_URL; ?>/themes/aostawork/resources/js/bin/materialize.js"></script>
    <script src="<?php echo $APP_URL; ?>/themes/aostawork/resources/js/sideNav.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="<?php echo $APP_URL; ?>/resource/lachance/js/gmaps.min.js"></script>
    <script src="<?php echo $APP_URL; ?>/resource/lachance/js/jquery.cookiebar.min.js"></script>

</head>
<body>
<script>
    (function () {
        $.cookieBar({
            message: 'Questo sito utilizza cookies per migliorare l\'esperienza utente e per finalità statistiche. Chiudendo questo banner o scorrendo questa pagina acconsenti all’uso dei cookie.',
            acceptButton: true,
            acceptText: 'Ho capito',
            acceptFunction: null,
            declineButton: true,
            declineText: 'Disabilita i Cookies',
            declineFunction: null,
            policyButton: true,
            policyText: 'Leggi l\'informativa',
            policyURL: '<?php echo $this->router->link("/informazioni/{title}/{id}", ['cookie-policy', 9]); ?>',
            autoEnable: true,
            acceptOnContinue: false,
            acceptOnScroll: true,
            expireDays: 1,
            effect: 'slide',
            element: 'body',
            append: false,
            fixed: false,
            bottom: false,
            zindex: '',
            domain: '<?php echo $APP_URL; ?>',
        });
    })();

    if ($.cookieBar('cookies')) {

        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-74399266-1', 'auto');
        ga('send', 'pageview');
    }
</script>
<div id="fb-root"></div>
<script>

    $(document).ready(function () {

        if ($.cookieBar('cookies')) {
            $(document).ready(function () {
                (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v2.5&appId=264099726960475";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            });
        }
    });

</script>

<div class="container">
    <nav class="nav-wrapper">
        <a href="#" class="brand-logo">Logo</a>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="<?php echo $this->router->link('/'); ?>">Home</a></li>
            <li><a href="<?php echo $this->router->link('novita'); ?>">Novit&agrave;</a></li>
            <li><a href="<?php echo $this->router->link('pizze'); ?>">Pizze</a></li>
            <li><a href="<?php echo $this->router->link('dove_trovarci'); ?>">Dove trovarci</a></li>
            <li><a href="<?php echo $this->router->link('chi_siamo'); ?>">Chi siamo</a></li>
        </ul>
        <ul class="side-nav" id="nav-mobile">
            <li><a href="<?php echo $this->router->link('/'); ?>">Home</a></li>
            <li><a href="<?php echo $this->router->link('novita'); ?>">Novit&agrave;</a></li>
            <li><a href="<?php echo $this->router->link('pizze'); ?>">Pizze</a></li>
            <li><a href="<?php echo $this->router->link('dove_trovarci'); ?>">Dove trovarci</a></li>
            <li><a href="<?php echo $this->router->link('chi_siamo'); ?>">Chi siamo</a></li>
        </ul>
    </nav>
    <!--
    <div class="">
        <div class="row">
            <div class="col x1">
                <a href="<?php /*echo $APP_URL */ ?> "><img
                        src="<?php /*echo $APP_URL . "/resource/lachance/images/logo.png"; */ ?>"></a>
            </div>
            <div class="uk-width-6-10">
                <a href="#" class="uk-navbar-toggle uk-visible-small uk-align-right" data-uk-offcanvas="{target:'#offcanvas-menu'}"></a>
            </div>
        </div>
    </div>-->


    <div class="col x12">
        <?php $this->content() ?>
    </div>

    <?php if (isset($slideshow)): ?>
        <!--        <div class="yx-slideshow uk-margin uk-animation uk-animation-scale">
            <?php /*$this->hook('SLIDESHOW', array('slideshowImages' => $slideshowImages)) */ ?>
        </div>-->

    <?php endif; ?>


    <?php if (isset($bannersBox)): ?>

        <!--    <div class="yx-banner uk-margin uk-animation uk-animation-slide-bottom">
            <?php /*$this->hook('BANNER_BOX', array('banners'=>$banners)) */ ?>
        </div>-->

    <?php endif; ?>

    <div class="row">
        <div class="col m12">
            <div class="col m4 card">
                <h3 class="card-title">Informazioni</h3>
                <?php if (isset($informazioni)): ?>
                    <div class="card-action">
                    <ul class="">
                        <?php foreach ($informazioni as $info): ?>
                            <li>
                                <a href="<?php echo $this->router->link('informazioni/{alias}/{id}', array($info->alias, $info->id)) ?>"> <?php echo $info->title ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col m4 card">
                <h3 class="card-title">A proposito di noi...</h3>
                <div class="card-content">
                    <ul class="">
                        <li class="><i class=""></i><span style="padding: 5px"> Siamo aperti tutti i giorni escluso il martedì, dalle 18:00 alle 22:00</span>
                        </li>
                        <li class=""><i class=""></i> <span style="padding: 5px"> Frazione Borrettaz N°5B, 11020 Aosta</span>
                        </li>
                        <li class=""><i class=""></i><span style="padding: 5px"> 335 5739358</span></li>
                        <li class=""><i class=""></i><span
                                    style="padding: 5px"> Partita IVA: 01192840070</span></li>
                    </ul>
                </div>


            </div>
            <div class="col m4">
                <div class="uk-panel-header">
                    <h3 class="uk-panel-title">Facebook</h3>
                </div>
                <div class="fb-page"
                     data-href="https://www.facebook.com/fPizzeria-La-Chance-1535271470048766/?ref=ts&amp;fref=ts"
                     data-small-header="true" data-adapt-container-width="true" data-hide-cover="true"
                     data-show-facepile="true"></div>
            </div>
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
