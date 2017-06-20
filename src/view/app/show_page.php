<div>
    <article class="uk-article uk-panel uk-panel-box uk-panel-box-primary">
        <div class="item-title uk-panel-header">
            <div class="uk-panel-title"><?php echo $item->title?> <span class="uk-align-right uk-text-medium"> <i class="uk-icon uk-icon-calendar"></i> <?php echo  date('d/m/y',strtotime($item->date_created)) ?> </span></div>
        </div>
        <div class="item-content">
            <p><?php echo htmlspecialchars_decode($item->content) ?></p>
        </div>
    </article>
</div>
