<?php
$title = $this->getTitle();
$buttons = $this->getButtons();
$formUrl = $this->getFormUrl();
$columns = $this->getColumns();
$collection = $this->getCollection();
$actions = $this->getActions();
$filter = $this->getFilter();
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline"><?= $title ?></p>
        <div id="buttons">
        <?php foreach ($buttons as $button) : ?>
            <?= $this->getButtonUrl($button); ?>
        <?php endforeach ?>
        </div>
    </div>
    <form id="filterForm" action="<?= $formUrl ?>">
    <table class="table">
        <thead class="thead-light">
            <tr>
            <?php foreach($columns as $column) : ?>
                <th scope="col" class="border-bottom-0"><?= $column['label'] ?></th>
            <?php endforeach ?>
            <?php if (count($actions)) : ?>
                <th scope="col" class="border-bottom-0">Actions</th>
            <?php endif ?>
            </tr>
            <tr>
            <?php foreach($columns as $column) : ?>
                <?php if (!empty($column['field'])) : ?>
                <th class="border-top-0"><div class="d-inline"><input class="w-100" type="text" name="filter[<?= get_class($this) ?>][<?= $column['field'] ?>]" value="<?= $filter[$column['field']] ?? '' ?>"></div></th>
                <?php else : ?>
                <th class="border-top-0">&nbsp;</th>
                <?php endif ?>
            <?php endforeach ?>
            <?php if (count($actions)) : ?>
                <th class="border-top-0">&nbsp;</th>
            <?php endif ?>
            </tr>
        </thead>
        <tbody>
        <?php if (!$collection || $collection->count() == 0) : ?>
            <tr>
                <td class="text-center" colspan="<?= count($columns) + (boolval(count($actions))) ?>">No Records Found.</td>
            </tr>
        <?php else : ?>
        <?php foreach ($collection as $row) : ?>
            <tr>
            <?php foreach ($columns as $column): ?>
                <td><?= $this->getValue($row, $column) ?></td>
            <?php endforeach ?>
            <?php if (count($actions)) : ?>
                <td>
                <?php foreach ($actions as $action) : ?>
                    <?= $this->getActionUrl($action, $row) ?>
                <?php endforeach ?>
                </td>
            <?php endif ?>
            </tr>
        <?php endforeach ?>
        <?php endif ?>
        </tbody>
    </table>
    </form>
</div>
