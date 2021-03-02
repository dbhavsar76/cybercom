<footer class="mt-auto">
<?php
foreach ($this->getChildren() as $child) {
    echo $child->render();
}
?>
</footer>
