<?php

namespace App\Controller;

use App\Model\Creature;
use App\Service\Router;
use App\Service\Templating;

class CreatureController
{
    public function indexAction(Templating $templating, Router $router): string
    {
        $creatures = Creature::findAll();
        return $templating->render('creature/index.html.php', [
            'creatures' => $creatures,
            'router' => $router
        ]);
    }

    public function showAction(int $creatureId, Templating $templating, Router $router): string
    {
        $creature = Creature::find($creatureId);
        if (!$creature) {
            http_response_code(404);
            return "Creature not found";
        }

        return $templating->render('creature/show.html.php', [
            'creature' => $creature,
            'router' => $router
        ]);
    }

    public function createAction(?array $requestPost, Templating $templating, Router $router): string
    {
        $creature = new Creature();

        if ($requestPost) {
            $creature->fill($requestPost);

            if ($this->validate($creature)) {
                $creature->save();
                $path = $router->generatePath('creature-index');
                $router->redirect($path);
                return '';
            }
        }

        return $templating->render('creature/create.html.php', [
            'creature' => $creature,
            'router' => $router
        ]);
    }

    public function editAction(int $creatureId, ?array $requestPost, Templating $templating, Router $router): string
    {
        $creature = Creature::find($creatureId);
        if (!$creature) {

            http_response_code(404);
            return "Creature not found";
        }

        if ($requestPost) {
            $creature->fill($requestPost);

            if ($this->validate($creature)) {
                $creature->save();
                $path = $router->generatePath('creature-index');
                $router->redirect($path);
                return '';
            }
        }

        return $templating->render('creature/edit.html.php', [
            'creature' => $creature,
            'router' => $router
        ]);
    }

    public function deleteAction(int $creatureId, Router $router): string
    {
        $creature = Creature::find($creatureId);
        if (!$creature) {

            http_response_code(404);
            return "Creature not found";
        }


        $creature->delete();
        $path = $router->generatePath('creature-index');
        $router->redirect($path);
        return '';
    }

    private function validate(Creature $creature): bool
    {
        $errors = [];

        if (empty($creature->getName())) {
            $errors[] = "Name cannot be empty.";
        }
        if (empty($creature->getDescription())) {
            $errors[] = "Description cannot be empty.";
        }
        if (!$creature->getLifespan() || $creature->getLifespan() <= 0) {
            $errors[] = "Lifespan must be a positive number.";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<p class='error'>{$error}</p>";
            }
            return false;
        }

        return true;
    }
}
