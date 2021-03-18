<?php
use \Model\Core\UrlManager;

$statuses = [
    \Model\CmsPage::STATUS_DISABLED => ['Disabled', 'btn-danger'],
    \Model\CmsPage::STATUS_ENABLED  => ['Enabled', 'btn-success']
];
$cmsPages = $this->cmsPages;
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">CMS Pages</p>
        <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('add', null, null, true) ?>').resetParams().load()" class="btn btn-success">Create CMS Page</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Identifier</th>
                <th scope="col">Status</th>
                <th scope="col">Created Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($cmsPages->count() == 0) : ?>
            <tr>
                <td class="text-center" colspan="6">No Records Found.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($cmsPages as $cmsPage) :
                $id = $cmsPage->{$cmsPage->getPrimaryKey()};
                [$status, $statusClass] = $statuses[$cmsPage->status];
            ?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $cmsPage->title ?></td>
                <td><?= $cmsPage->identifier ?></td>
                <td><a class="btn <?= $statusClass ?>" href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('toggleStatus', null, [$cmsPage->getPrimaryKey() => $id]) ?>').resetParams().load()"><?= $status ?></a></td>
                <td><?= $cmsPage->createdDate ?></td>
                <td>
                    <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('edit', NULL, [$cmsPage->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('delete', NULL, [$cmsPage->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
            <?php endforeach ?>
        <?php endif ?>
        </tbody>
    </table>
</div>
