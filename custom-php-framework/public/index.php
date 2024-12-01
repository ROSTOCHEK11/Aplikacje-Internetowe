<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php';

$config = new \App\Service\Config();

$templating = new \App\Service\Templating();
$router = new \App\Service\Router();

$action = $_REQUEST['action'] ?? null;
switch ($action) {
    // Посты
    case 'post-index':
    case null:
        $controller = new \App\Controller\PostController();
        $view = $controller->indexAction($templating, $router);
        break;
    case 'post-create':
        $controller = new \App\Controller\PostController();
        $view = $controller->createAction($_REQUEST['post'] ?? null, $templating, $router);
        break;
    case 'post-edit':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\PostController();
        $view = $controller->editAction($_REQUEST['id'], $_REQUEST['post'] ?? null, $templating, $router);
        break;
    case 'post-show':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\PostController();
        $view = $controller->showAction($_REQUEST['id'], $templating, $router);
        break;
    case 'post-delete':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\PostController();
        $view = $controller->deleteAction($_REQUEST['id'], $router);
        break;

    // Существа (Creatures)
    case 'creature-index':
    case null:
        $controller = new \App\Controller\CreatureController();
        $view = $controller->indexAction($templating, $router);
        break;
    case 'creature-create':
        $controller = new \App\Controller\CreatureController();
        $view = $controller->createAction($_REQUEST['creature'] ?? null, $templating, $router);
        break;
    case 'creature-edit':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\CreatureController();
        $view = $controller->editAction($_REQUEST['id'], $_REQUEST['creature'] ?? null, $templating, $router);
        break;
    case 'creature-show':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\CreatureController();
        $view = $controller->showAction($_REQUEST['id'], $templating, $router);
        break;
    case 'creature-delete':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\CreatureController();
        $view = $controller->deleteAction($_REQUEST['id'], $router);
        break;

    // Информация
    case 'info':
        $controller = new \App\Controller\InfoController();
        $view = $controller->infoAction();
        break;

    default:
        $view = 'Not found';
        break;
}

if ($view) {
    echo $view;
}
