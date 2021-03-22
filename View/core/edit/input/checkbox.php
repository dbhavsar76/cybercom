<?php
$attribute = $this->getAttribute();
$entity = $this->getEntity();
?>

<div class="form-group">
<?php 
$ids = explode(',', $entity->{$attribute->code});
foreach($attribute->getOptions() as $option) :
    $id = $option->{$option->getPrimaryKey()}; 
?>
    <div class="form-check">
        <input type="checkbox" name="<?= "{$entity->getTableName()}[attributes][{$attribute->code}][]" ?>" value="<?= $id ?>" id="op-<?= $id ?>" class="form-check-input" <?= in_array($id, $ids) ? 'checked' : '' ?>>
        <label for="<?= $id ?>" class="form-check-label"><?= $option->name ?></label>
    </div>
<?php endforeach ?>
</div>