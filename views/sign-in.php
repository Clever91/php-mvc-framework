<h1>Sign In</h1>

<?php

use app\core\form\Form;

$this->title = "Sing In";

$form = Form::begin('', 'post'); ?>

<div class="mb-3">
    <div class="form-group">
        <?= $form->textField($model, "username", "Username"); ?>
    </div>
</div>

<div class="mb-3">
    <div class="form-group">
        <?= $form->passwordField($model, "password", "Password"); ?>
    </div>
</div>

<div class="form-check">
    <?= $form->checkboxField($model, "rememberMe", "Check me out"); ?>
</div>

<div class="mb-3">
    <div class="form-group">
        <?= $form->submitField(name: "submit", label: "Sign In") ?>
    </div>
</div>
<?php Form::end(); ?>

<span>If you don't have an account, you may <a href="/signUp" class="btn btn-link">sign up</a></span>