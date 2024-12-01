<?php

/** @var \App\Model\Creature $creature */
/** @var \App\Service\Router $router */

$title = "Edit Post {$creature->getName()} ({$creature->getId()})";
$bodyClass = 'edit';

ob_start(); ?>
    <h1><?= $title ?></h1>
    <form action="<?= $router->generatePath('creature-edit') ?>" method="post" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
        <input type="hidden" name="action" value="creature-edit">
        <input type="hidden" name="id" value="<?= $creature->getId() ?>">
    </form>

    <ul class="action-list">
        <li>
            <a href="<?= $router->generatePath('creature-index') ?>">Back to list</a></li>
        <li>
            <form action="<?= $router->generatePath('creature-delete') ?>" method="post">
                <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                <input type="hidden" name="action" value="creature-delete">
                <input type="hidden" name="id" value="<?= $creature->getId() ?>">
            </form>
        </li>
    </ul>

<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
