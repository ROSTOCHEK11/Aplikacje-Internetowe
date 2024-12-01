<?php

/** @var \App\Model\Creature[] $creatures */
/** @var \App\Service\Router $router */

$title = 'Creatures List';
$bodyClass = 'index';

ob_start(); ?>
    <h1>Creatures List</h1>

    <a href="<?= $router->generatePath('creature-create') ?>">Create new</a>

    <ul class="index-list">
        <?php foreach ($creatures as $creature): ?>
            <li><h3><?= $creature->getName(); ?></h3>
                <ul class="action-list">
                    <li><a href="<?= $router->generatePath('creature-show', ['id' => $creature->getId()]) ?>">Details</a></li>
                    <li><a href="<?= $router->generatePath('creature-edit', ['id' => $creature->getId()]) ?>">Edit</a></li>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
