<?php
$attribute = $this->getAttribute();
$entity = $this->getEntity();
?>

<div class="form-group">
    <input type="text" id="" class="form-control" name="<?= "{$entity->getTableName()}[attributes][{$attribute->code}]" ?>" value="<? $entity->{$attribute->code} ?>">
</div>