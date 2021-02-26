<?php use Webapp\Auth\Auth as Auth; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav mr-auto">
            <?php if (Auth::user_id()): ?>
                <li>
                    <a class="nav-link" href="index.php"><i class="fad fa-user-edit"></i> Személyes adatok </a>
                </li>
                <li>
                    <a class="nav-link" href="address.php"><i class="fal fa-address-card"></i> Címek</a>
                </li>
                <li>
                    <a class="nav-link" href="log.php"><i class="fad fa-history"></i> Előzmények</a>
                </li>
            <?php else : ?>
                <li>
                    <a class="nav-link" href="index.php"><i class="fad fa-home"></i></a>
                </li>
            <?php endif; ?>
        </ul>

        <ul class="navbar-nav">
            <?php if (!Auth::user_id()): ?>
                <li><a class="nav-link" href="login.php"><i class="fad fa-user-lock"></i> Bejelentkezés </a></li>
                <li><a class="nav-link" href="reg.php"><i class="fad fa-user-plus"></i> Regisztráció</a></li>
            <?php else: ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#" id="navbarDropdown"
                       role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">
                        <i class="fad fa-user pr-2"></i> <?php echo Auth::name(); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="logout.php">Kijelentkezés</a>
                    </div>
                </li>

            <?php endif; ?>
        </ul>

    </div>
</nav>