<?php
$attributes = $this->attributes;
?>

<fieldset>
    <legend>Attributes</legend>
    <?php if ($attributes->count() === 0) : ?>
        <div class="text-center">No Attributes Created.</div>
    <?php else: ?>
        <?php foreach ($attributes as $attribute) : 
            $pk = $attribute->getPrimaryKey();
        ?>
        <div class="form-group">
            <label for="attribute-<?= $attribute->$pk ?>"><?= $attribute->name ?></label>
        </div>
        <?php endforeach ?>
    <?php endif?>
</fieldset>