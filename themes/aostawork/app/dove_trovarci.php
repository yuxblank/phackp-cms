<?php
/**
 * Created by PhpStorm.
 * User: TheCo
 * Date: 06/01/2016
 * Time: 09:42
 */
?>
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
                <h3 class="uk-panel-title">Dove trovarci</h3>
            </div>
            <div id="map-canvas" style="min-height: 400px">

            </div>


        </article>

</div>

<script>

    var map = new GMaps({
        div: '#map-canvas',
        lat: 45.72681691,
        lng: 7.30999589
    });

    map.addMarker(
        {
            lat: 45.72681691,
            lng: 7.30999589,
            title: 'Pizzeria la chance',
//            click: function(e) {
//                alert('You clicked in this marker')
//            },
            infoWindow: {
                content: '<h3 style="color: #000;">Ci trovi qui!</h3>'
            }
        }
    )


</script>
