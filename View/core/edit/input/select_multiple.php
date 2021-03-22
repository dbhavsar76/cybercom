<?php
$attribute = $this->getAttribute();
$entity = $this->getEntity();
?>

<div class="form-group">
    <select id="" name="<?= "{$entity->getTableName()}[attributes][{$attribute->code}][]" ?>" class="custom-select" multiple>
    <?php 
    $ids = explode(',', $entity->{$attribute->code});
    foreach ($this->getAttribute()->getOptions() as $option) : 
        $id = $option->{$option->getPrimaryKey()};
    ?>
        <option value="<?= $id ?>" <?=  in_array($id, $ids) ? 'selected' : '' ?>><?= $option->name ?></option>
    <?php endforeach ?>
    </select>
</div>
