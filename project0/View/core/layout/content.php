<section id="content" class="my-3">
<?php
foreach ($this->getChildren() as $key => $child) {
    echo $child->render();
}
?>
</section>
