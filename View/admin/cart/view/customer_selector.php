<?php
use Model\Core\UrlManager;
$customers = $this->customers;
$currentCustomer = $this->currentCustomer;
?>
<div class="d-flex p-2">
    <label for="select-customer" class="align-middle h4">Select Customer</label>
    <select name="customer" id="select-customer" class="custom-select">
        <?php if (!$currentCustomer) : ?>
            <option value="">Select Customer</option>
        <?php endif ?>
        <?php foreach ($customers as $id => $customerName) : ?>
        <option value="<?= $id ?>" <?= $id == $currentCustomer ? 'selected' : '' ?>><?= $customerName ?></option>
        <?php endforeach ?>
    </select>
</div>    
<script>
    $('#select-customer').change(function (e) {
        if (this.value) {
            mage.resetParams().setUrl(`<?= UrlManager::getUrl(null, null, null, true) ?>&current_customer=${this.value}`).load();
        }
    });
</script>