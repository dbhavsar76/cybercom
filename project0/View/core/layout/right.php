<section id="right-sidebar">
<?php foreach ($this->getChildren() as $child) {
    echo $child->render();
} ?>
</section>
