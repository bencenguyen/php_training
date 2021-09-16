<nav class="navbar navbar-expand-1g navbar-dark bg-dark">
    <a class="navbar-brand" href="/php_training">My Photos</a>
    <?php if($user["loggedIn"]): ?>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
        <?php esc($user["name"]) ?>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/php_training/logout">Logout</a>
            <a class="dropdown-item" href="/php_training/profile">Profile</a>
        </div>
    </div>
    <?php else: ?>
    <ul class="navbar-nav pull-right">
        <li class="nav-item active">
            <a class="nav-link" href="/php_training/login">Login</a>
        </li>
    </ul>
    <?php endif ?>
</nav>