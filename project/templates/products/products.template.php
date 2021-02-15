<section class="my-3">
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Products</p>
        <a href="<?= BASE_URL ?>products/addProduct.php" class="btn btn-success">Create Product</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">SKU</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Discount</th>
                <th scope="col">Quantity</th>
                <th scope="col" style="width: 320px;">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Created Date</th>
                <th scope="col">Updated Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>PR001</td>
                <td>Product 1</td>
                <td>12345</td>
                <td>123</td>
                <td>12</td>
                <td class="">Product 1 Description Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur sed repellendus voluptatum magni autem soluta unde, nesciunt error eos sapiente laboriosam nobis dicta.</td>
                <td class="text-success">Enabled</td>
                <td>12-12-1212 12:12:12 AM</td>
                <td>12-12-1212 12:12:12 AM</td>
                <td>
                    <a href="<?= BASE_URL ?>products/updateProduct.php" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</section>