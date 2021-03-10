<?php include ROOT.'/View/core/start.php'; ?>
<div id="message">
</div>
<?php foreach ($this->getChildren() as $child) {
    echo $child->render();
} ?>
<?php include ROOT.'/View/core/end.php'; ?>