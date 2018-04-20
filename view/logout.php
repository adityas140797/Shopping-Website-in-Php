<?php

    session_destroy();
    unset($_SESSION);

resetStatus();

header("location:index.php?p=home");