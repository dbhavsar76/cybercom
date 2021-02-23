<footer class="mt-auto">
<?php
foreach ($this->getChildren() as $child) {
    $child->render();
}
?>
</footer>
