<?php
/** @var \App\Model\Creature $creature */
/** @var \App\Service\Router $router */

$title = "{$creature->getName()} ({$creature->getId()})";
$bodyClass = 'show';

ob_start(); ?>
    <h1><?= $creature->getName() ?></h1>
    <article>
        <?= $creature->getDescription();?>
    </article>
    <h2> - - -</h2>
    <article>
        lifespan: <?= $creature->getLifespan();?> years
    </article>

    <ul class="action-list">
        <li> <a href="<?= $router->generatePath('creature-index') ?>">Back to list</a></li>
        <li><a href="<?= $router->generatePath('creature-edit', ['id'=> $creature->getId()]) ?>">Edit</a></li>
    </ul>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
