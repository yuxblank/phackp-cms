<?php
use controller\Secured;
use yuxblank\phackp\core\Router;
// TODO take this to controller superclass
$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1));
$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
$root = ltrim ($uri, '/');
if ($adminMenu!=null) { ?>
  <div class="uk-panel uk-panel-box uk-float-left uk-hidden-large">
  <nav class="">
      <ul class="uk-nav uk-nav-side uk-nav-parent-icon ">

<?php foreach ($adminMenu->menu as $menu):

    if ($menu->acl > Secured::loadUser()->role){
        continue;
    }
      $active = '';

      if (isset($menu->url) && $menu->url === $root) {
      $active = 'uk-active';
      }


  ?>
        <?php if (!isset($menu->parent)) { ?>
        <li class='<?php echo $active ?>'><a href="<?php echo Router::link($menu->url); ?>"><i class="<?php echo $menu->icon ?>"></i> <?php echo $menu->label ?></a></li>
      <?php } else { ?>
      <li class="uk-nav-parent">
            <ul class="uk-nav uk-nav-parent-icon" data-uk-nav>
                <li class="uk-parent">
                    <a href="#"><i class="<?php echo $menu->icon?>"></i> <?php echo $menu->label ?></a>
                    <ul class="uk-nav-sub">
                    <?php foreach ($menu->parent as $parent):
                        if ($parent->acl > Secured::loadUser()->role){
                            continue;
                        }
                      $active = '';
                      if ($parent->url === $root) {
                      $active = 'uk-active';
                      }
                      ?>
                      <li class="<?php echo $active ?>"><a href="<?php echo Router::link($parent->url);?>"><?php echo $parent->label ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </li>
        <?php } ?>


<?php
    endforeach;
  }

 ?>
       </ul>
         </nav>
      <?php if ($menu) { ?>
      <button class="uk-button uk-button-danger uk-button uk-align-center uk-margin-top"
              onclick="window.location.replace('<?php echo Router::link('admin/logout') ?>')">
          <i class='uk-icon uk-icon uk-icon-power-off'></i> Esci</button>
      <?php } ?>
</div>
