<?php 

require_once '../AuthMVC/App/models/User/User.php';

use AuthMVC\App\models\User\User;

$user = new User();
$user->logout();
