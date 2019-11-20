<div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ingreso</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <!-- <form action="customer-orders.html" method="post"> -->
                <form onsubmit='login(this); return false;'>
                    <div class="form-group">
                        <input id="email" type="text" placeholder="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" placeholder="password" class="form-control" required>
                    </div>
                    <p class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Aceptar</button>
                    </p>
                </form>
                <p class="text-center text-muted">No estás registrado aún?</p>
                <p class="text-center text-muted">
                    <a href="register.php">
                        <b>Registrate ahora</b>
                    </a>
                    ! Es fácil y en menos de un minuto te damos accesso !
                </p>
            </div>
        </div>
    </div>
</div>
