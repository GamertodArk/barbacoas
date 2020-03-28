<li class="bell-notification">
    <i id="notification-icon-nav" class="fas fa-bell"></i>

    <div id="notifications-triangle" class="triangle"></div>

    <div id="notification-items">

        <div class="items-wrap">
            <!-- <h2>No tienes notificaciones</h2> -->

            <?php for ($i = 1 ; $i <= 10 ; $i++):?>
                <div class="item">
                    <div class="img"></div>
                    <span class="data">
                        <p>¡Producto alquilado!</p>
                        <a href="#">Ver producto</a>
                    </span>
                    <span class="remove-item">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            <?php endfor; ?>
        </div>

        <a href="#">Ver todas las notificaciones</a>
    </div>
</li>
