<h1>Sign In</h1>

<?php

use app\core\form\Form;

$form = Form::begin('', 'post'); ?>

<div class="mb-3">
    <?= $form->textField($model, "username", "Username"); ?>
</div>

<div class="mb-3">
    <?= $form->passwordField($model, "password", "Password"); ?>
</div>

<div class="form-check">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
</div>

<div class="mb-3">
    <button class="form-control btn btn-primary" name="submit" type="submit">Sign In</button>
</div>
<?php Form::end(); ?>

<span>If you don't have an account, you may <a href="/signUp" class="btn btn-link">sign up</a></span>