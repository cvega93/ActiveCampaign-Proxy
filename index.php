<?php
namespace App;
require 'vendor/autoload.php';

$activeCampaign = new ActiveCampaign();

call_user_func_array([$activeCampaign, $_GET['method']], [$_REQUEST]);