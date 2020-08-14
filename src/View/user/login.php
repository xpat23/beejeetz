<div style="padding: 25px;">
    <h4>Авторизация</h4>
    <hr>
    <div class="card" style="width: 18rem; margin: 0 auto;">
        <div class="card-body">
            <?php if(isset($args['error'])) { ?>
            <div class="alert alert-danger">
                <?=$args['error'] ?>
            </div>
            <?php } ?>
            <form method="post">
                <div class="form-group">
                    <input type="text" class="form-control" required name="username" placeholder="Имя пользователя">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" required name="password" placeholder="Пароль">
                </div>
                <input type="submit" value="Войти" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
