<?php 
include ROOT.'/View/core/start.php';

$this->getChild('header')->render();
$this->getChild('content')->render();
$this->getChild('footer')->render();

include ROOT.'/View/core/end.php';