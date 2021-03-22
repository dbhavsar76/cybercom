<div id="header">
<?php foreach ($this->getChildren() as $child) {
    echo $child->render();
}
?>
</div>