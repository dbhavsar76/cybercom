<?php

foreach ($this->getChildren() as $key => $child) {
    echo $child->render();
}
?>
