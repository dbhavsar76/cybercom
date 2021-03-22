<?php $brands = $this->collection; ?>
<!-- Client Brand -->
<section id="aa-client-brand">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-client-brand-area">
                    <ul class="aa-client-brand-slider">
                    <?php foreach ($brands as $brand) : ?>
                        <li><a href="#"><img src="<?= $brand->getImageUrl() ?>" height="100px" alt="<?= $brand->name ?>" class="img-fluid"></a></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Client Brand -->
