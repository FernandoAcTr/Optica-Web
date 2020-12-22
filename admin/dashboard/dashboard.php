<?php

include_once '../class/database.class.php';

$sistema->verificarPermiso('Dashboard');
include 'views/index.php';
