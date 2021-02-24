<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link active" href="index.php">Személyes adatok <span class="sr-only">(current)</span></a>
            <a class="nav-link" href="address.php?user_id=<?php echo $user_id ?>">Címek</a>
            <a class="nav-link" href="log.php?user_id=<?php echo $user_id ?>">Előzmények</a>

        </div>
    </div>
</nav>