<?php
$attribute = $this->getAttribute();
$entity = $this->getEntity();
?>

<div class="form-group">
    <select id="" name="<?= "{$entity->getTableName()}[attributes][{$attribute->code}]" ?>" class="custom-select">
        <option value="">Select</option>
    <?php foreach ($this->getAttribute()->getOptions() as $option) : 
        $id = $option->{$option->getPrimaryKey()};
    ?>
        <option value="<?= $id ?>" <?= $entity->{$attribute->code} == $id ? 'selected' : '' ?>><?= $option->name ?></option>
    <?php endforeach ?>
    </select>
</div>
