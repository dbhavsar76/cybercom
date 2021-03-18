<div class="alert <?= $this->alertClass ?> alert-dismissible" style="display: none;" role="alert">
    <?= $this->alertMessage ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<script>
$('.alert').slideDown(500).delay(5000).slideUp(500, function() {
    $(this).alert('close');
});
</script>