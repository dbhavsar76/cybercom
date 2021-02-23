<section id="content" class="my-3">
<?php
foreach ($this->getChildren() as $child) {
    $child->render();
}
?>
</section>
