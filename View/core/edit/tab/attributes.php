<?php

use Block\Core\Edit\Input;
$entity = $this->entity; # any table model (product, category, etc.)
$attributes = $this->attributes;
?>

<p class="h2">Attributes</p>
<?php if ($attributes->count() === 0) : ?>
    <div class="text-center">No Attributes Created.</div>
<?php else: ?>
    <?php foreach ($attributes as $attribute) : 
        $pk = $attribute->getPrimaryKey();
    ?>
<fieldset>
    <legend><?= $attribute->name ?></legend>
<?php
    $input = new Input($attribute);
    $input->setEntity($entity);
    echo $input->render();
?>
</fieldset>
    <?php endforeach ?>
<?php endif?>