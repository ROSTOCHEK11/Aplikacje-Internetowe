<?php

/** @var \App\Model\Creature $creature */
/** @var \App\Service\Router $router */

$title = 'Create Creature';
$bodyClass = 'edit';

ob_start(); ?>
    <h1>Create Creature</h1>
    <form action="<?= $router->generatePath('creature-create') ?>" method="post" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
        <input type="hidden" name="action" value="creature-create">
    </form>
    <a href="<?= $router->generatePath('creature-index') ?>">Back to list</a>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
