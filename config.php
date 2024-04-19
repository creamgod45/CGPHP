<?php

require "autoload.php";

use Type\Array\CGArray;
use Utils\ConfigKeyField;

$CGArray = new CGArray();
$CGArray->Set(ConfigKeyField::Name->value, "CGPHP 網站");
$CGArray->Set(ConfigKeyField::Description->value, "CGPHP");
$CGArray->Set(ConfigKeyField::Version->value, "1.12.0");
$CGArray->Set(ConfigKeyField::Auther->value, "creamgod45");

return $CGArray;