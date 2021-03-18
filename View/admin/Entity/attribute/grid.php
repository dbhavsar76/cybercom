<?php
use Model\Core\UrlManager; 
$attribute = new Model\Entity\Attribute;
$attributes = $this->attributes;
$entityTypeMapping = (new Model\Entity\Type)->getMapping();
$inputTypes = $attribute->getInputTypeOptions();
$backendTypes = $attribute->getBackendTypeOptions();
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Attributes</p>
        <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('add', null, null, true) ?>').resetParams().load()" class="btn btn-success">Add Attribute</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Entity Type</th>
                <th scope="col">Name</th>
                <th scope="col">Code</th>
                <th scope="col">Input Type</th>
                <th scope="col">Backend Type</th>
                <th scope="col">Backend Model</th>
                <th scope="col">Sort Order</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($attributes->count() == 0) : ?>
            <tr>
                <td class="text-center" colspan="9">No Records Found.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($attributes as $attribute) :
                $id = $attribute->{$attribute->getPrimaryKey()};
            ?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $entityTypeMapping[$attribute->entityTypeId] ?></td>
                <td><?= $attribute->name ?></td>
                <td><?= $attribute->code ?></td>
                <td><?= $inputTypes[$attribute->inputTypeId] ?></td>
                <td><?= $backendTypes[$attribute->backendType] ?></td>
                <td><?= $attribute->backendModel ?></td>
                <td><?= $attribute->sortOrder ?></td>
                <td>
                    <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('edit', NULL, [$attribute->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('delete', NULL, [$attribute->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
            <?php endforeach ?>
        <?php endif ?>
        </tbody>
    </table>
</div>
