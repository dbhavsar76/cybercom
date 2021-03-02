<section id="left-sidebar">
<?php foreach ($this->getChildren() as $child) {
    echo $child->render();
} ?>
</section>
