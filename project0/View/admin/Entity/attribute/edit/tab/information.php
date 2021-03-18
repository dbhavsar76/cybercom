<?php
$attribute = $this->attribute;
$entityTypes = $this->entityTypes;
$inputTypes = $attribute->getInputTypeOptions();
$backendTypes = $attribute->getBackendTypeOptions();
?>

<fieldset class="mx-0">
    <legend>Information</legend>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="attribute[name]" id="name" class="form-control" value="<?= $attribute->name ?>">
    </div>
    <div class="form-group">
        <label for="entity-type">Entity Type</label>
        <select name="attribute[entityTypeId]" id="entity-type" class="form-control" <?= $attribute->entityTypeId ? 'disabled' : '' ?>>
            <option value="">Select Entity</option>
        <?php foreach($entityTypes as $entityType) { 
            $id = $entityType->{$entityType->getPrimaryKey()};
        ?>
            <option value="<?= $id ?>" <?= $id == $attribute->entityTypeId ? 'selected' : '' ?>><?= $entityType->name ?></option>
        <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="code">Attribute Code</label>
        <input type="text" name="attribute[code]" id="code" class="form-control" value="<?= $attribute->code ?>" <?= $attribute->code ? 'disabled' : '' ?>>
    </div>
    <div class="form-group">
        <label for="input-type">Input Type</label>
        <select name="attribute[inputTypeId]" id="input-type" class="form-control" <?= $attribute->inputTypeId ? 'disabled' : '' ?>>
            <option value="">Select Input Type</option>
        <?php foreach($inputTypes as $inputType => $label) { ?>
            <option value="<?= $inputType ?>" <?= $inputType == $attribute->inputTypeId ? 'selected' : '' ?>><?= $label ?></option>
        <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="backend-type">Backend Type</label>
        <select name="attribute[backendType]" id="backend-type" class="form-control" <?= $attribute->backendType ? 'disabled' : '' ?>>
            <option value="">Select Backend Type</option>
        <?php foreach($backendTypes as $backendType => $label) { ?>
            <option value="<?= $backendType ?>" <?= $backendType == $attribute->backendType ? 'selected' : '' ?>><?= $label ?></option>
        <?php } ?>        
        </select>
    </div>
    <div class="form-group">
        <label for="backend-model">Backend Model</label>
        <input type="text" name="attribute[backendModel]" id="backend-model" class="form-control" value="<?= $attribute->backendModel ?>" <?= $attribute->backendModel ? 'disabled' : '' ?>>
    </div>
    <div class="form-group">
        <label for="sort-order">Sort Order</label>
        <input type="number" name="attribute[sortOrder]" id="sort-order" class="form-control" value="<?= $attribute->sortOrder ?? 1 ?>">
    </div>
</fieldset>