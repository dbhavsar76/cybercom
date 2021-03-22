<?php
$brand = $this->brand;
?>

<div class="form-group">
    <label for="brand-name">Brand Name</label>
    <input type="text" name="brand[name]" id="brand-name" class="form-control" value="<?= $brand->name ?>">
</div>
<div class="form-group">
    <label class="d-block">Brand Logo</label>
    <div class="custom-file w-25">
        <input type="file" name="logo" id="brand-logo" class="custom-file-input">
        <label for="brand-logo" class="custom-file-label">Choose Image File</label>
    </div>
</div>
<div class="form-group">
    <label for="brand-status">Status</label>
    <select name="brand[status]" id="brand-status" class="custom-select">
        <option value="<?= $brand::STATUS_ENABLED ?>">Enabled</option>
        <option value="<?= $brand::STATUS_DISABLED ?>" <?= $brand->status == $brand::STATUS_DISABLED ? 'selected' : '' ?>>Disabled</option>
    </select>
</div>
<div class="form-group">
    <label for="brand-sortOrder">Sort Order</label>
    <input type="number" name="brand[sortOrder]" id="brand-sortOrder" class="form-control" value="<?= $brand->sortOrder ?? 1 ?>">
</div>
<script type="application/javascript">
    $('#brand-logo').change(function(e){
        let fileName = e.target.files[0]?.name;
        $('.custom-file-label').html(fileName != undefined ? fileName : 'Choose Image File');
    });
</script>
