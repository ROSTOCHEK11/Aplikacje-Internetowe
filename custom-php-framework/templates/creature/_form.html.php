<?php
/** @var \App\Model\Creature $creature */
?>

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" id="name" name="creature[name]" value="<?= $creature->getName(); ?>">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="creature[description]"><?= $creature->getDescription(); ?></textarea>
</div>

<div class="form-group">
    <label for="lifespan">Lifespan</label>
    <input type="number" id="lifespan" name="creature[lifespan]" value="<?= $creature->getLifespan(); ?>">
</div>

<div class="form-group">
    <label></label>
    <input type="submit" value="Submit">
</div>
