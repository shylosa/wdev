<?php

require_once 'classes/SiteCode.php';

$source = 'https://colorlib.com/etc/glint/index.html';
//$source = 'http://code.mu/tasks/css/osnovnye-css-svojstva-dlya-novichkov.html';

$objectSite = new SiteCode();
$objectSite->setAddress($source);

$newCode = $objectSite->getWrappedCode('div');

echo $newCode;