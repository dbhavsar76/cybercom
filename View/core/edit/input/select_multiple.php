
<div class="form-group">
    <label for="<?= $this->getId() ?>"></label>
    <select id="<?= $this->getId() ?>" name="<?= $this->getName() ?>" class="custom-select" multiple>
    <?php foreach ($this->getOptions() as $option) : ?>
        <option value="<?= $option->{$option->getPrimaryKey()} ?>"><?= $option->name ?></option>
    <?php endforeach ?>
    </select>
</div>
