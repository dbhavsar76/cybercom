<?php include ROOT.'/View/core/start.php'; ?>
<?php foreach ($this->getChildren() as $child) {
    $child->render();
} ?>
<?php include ROOT.'/View/core/end.php'; ?>