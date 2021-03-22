<?php
$attribute = $this->getAttribute();
$entity = $this->getEntity();
?>

<div class="form-group">
    <input type="number" id="" class="form-control" name="<?= "{$entity->getTableName()}[attributes][{$attribute->code}]" ?>" value="<? $entity->{$attribute->code} ?>">
</div>