<?php

use Model\Core\UrlManager;

$options = $this->options;
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Edit Attribute</p>
    </div>
    <hr class="hr-dark">
    <form class="w-100" id="options-form" method="post" action="<?= UrlManager::getUrl('update') ?>">
    <fieldset>
        <legend>Options</legend>
        <input id="remove-ids" type="hidden" name="options[remove]" value="">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <td><a href="javascript:void(0);" onclick="mage.resetParams().setForm('#options-form').load()" class="btn btn-primary">Update</a></td>
                    <td>&nbsp;</td>
                    <td><a href="javascript:void(0);" class="btn btn-success" onclick="addNewOption()">Add Option</a></td>
                </tr>
                <tr>
                    <th scope="col">Option</th>
                    <th scope="col">Sort Order</th>
                    <th scope="col">Action</td>
                </tr>
            </thead>
            <tbody id="option-table-body">
            <?php if ($options->count() == 0) : ?>
                <tr id="no-record">
                    <td class="text-center" colspan="3">No Records Found.</td>
                </tr>
            <?php else : ?>
                <?php foreach ($options as $option) :
                    $id = $option->{$option->getPrimaryKey()};
                ?>
                <tr>
                    <td><input type="text" name="options[existing][<?= $id ?>][name]" class="form-control" value="<?= $option->name ?>"></td>
                    <td><input type="number" name="options[existing][<?= $id ?>][sortOrder]" class="form-control" value="<?= $option->sortOrder ?>"></td>
                    <td><a href="javascript:void(0);" class="btn btn-danger" data-id="<?= $id ?>" onclick="removeOption(this)">Remove</a></td>
                </tr>    
                <?php endforeach ?>
            <?php endif ?>
            </tbody>
        </table>
        </fieldset>
    </form>
</div>
<template id="new-option-row">
    <tr>
        <td><input type="text" name="options[new][][name]" class="form-control"></td>
        <td><input type="number" name="options[new][][sortOrder]" class="form-control"></td>
        <td><a href="javascript:void(0);" class="btn btn-danger" onclick="removeOption(this)">Remove</a></td>
    </tr>
</template>
<script>

var i = 0;

function addNewOption() {
    const template = document.querySelector('#new-option-row');
    const row = $(template.content.cloneNode(true));

    row.find('input[type=text]').attr('name', `options[new][${i}][name]`);
    row.find('input[type=number]').attr('name', `options[new][${i}][sortOrder]`);
    i++;
    row.prependTo('#option-table-body');
    $('#no-record').addClass('d-none');
}

function removeOption(buttonElement) {
    const id = $(buttonElement).data('id');
    
    if (id) {
        let ids = $('#remove-ids').val();
        if (ids.length !== 0) {
            ids += ',';
        }
        ids += id;
        $('#remove-ids').val(ids);
    }
    
    $(buttonElement).closest('tr').remove();
    if (document.querySelector('#option-table-body').rows.length == 1) {
        $('#no-record').removeClass('d-none');
    }
}

</script>