<?php
$attribute = $this->getAttribute();
$entity = $this->getEntity();
?>

<div class="form-group">
    <textarea name="<? "{$entity->getTableName()}[attributes][{$attribute->code}]" ?>" id="" class="form-control"><?= $entity->{$attribute->code} ?></textarea>
</div>