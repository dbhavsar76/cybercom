<header>
<?php foreach ($this->getChildren() as $child) {
    $child->render();
}
?>
</header>