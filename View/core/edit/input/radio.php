<?php
$attribute = $this->getAttribute();
$entity = $this->getEntity();
?>

<div class="form-group">
<?php foreach($attribute->getOptions() as $option) :
    $id = $option->{$option->getPrimaryKey()}; 
?>
    <div class="form-check">
        <input type="radio" name="<?= "{$entity->getTableName()}[attributes][{$attribute->code}]" ?>" value="<?= $id ?>" id="op-<?= $id ?>" class="form-check-input" <?= $entity->{$attribute->code} == $id ? 'checked' : '' ?>>
        <label for="<?= $id ?>" class="form-check-label"><?= $option->name ?></label>
    </div>
<?php endforeach ?>
</div>