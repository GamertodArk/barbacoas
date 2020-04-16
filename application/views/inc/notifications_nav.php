<li class="bell-notification">
    <i id="notification-icon-nav" class="fas fa-bell"></i>

    <div id="notifications-triangle" class="triangle"></div>



    <?php if(count($notifications) > 0): ?>
        <span id="notifications_counter" data-notifi-counter="<?=count($notifications)?>"><?=count($notifications)?></span>
    <?php else: ?>
        <span class="hide" id="notifications_counter" data-notifi-counter="0">0</span>
    <?php endif; ?>

    <div id="notification-items">

        <?php if(count($notifications) > 0): ?>

        <div class="items-wrap">
                <?php foreach ($notifications as $notification): ?>
                    <div data-notification-id="<?=$notification['id']?>" class="item">
                        <img src="<?php echo base_url('img/products/' . $notification['thumnail']) ?>" alt="">
                        <span class="data">
                            <p>¡Producto alquilado!</p>
                            <a href="<?=site_url('products/review/' . $notification['product_id'])?>">Ver producto</a>
                        </span>
                        <span onclick="delete_notification(this.parentNode)" class="remove-item">
                            <i class="fas fa-times"></i>
                        </span>
                    </div>
                <?php endforeach; ?>
        </div>

        <?php else: ?>
            <div class="items-wrap empty">
                <h2>No tienes notificaciones</h2>
            </div>
        <?php endif; ?>

        <a href="#">Ver todas las notificaciones</a>
    </div>
</li>
