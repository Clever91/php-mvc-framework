<h1>Sign In</h1>

<?php

use app\core\form\Form;

$form = Form::begin('', 'post'); ?>

<div class="mb-3">
    <?= $form->textField($model, "username", "Username", [
        "labelClass" => "form-label",
        "inputClass" => "form-control"
    ]); ?>
</div>

<div class="mb-3">
    <?= $form->passwordField($model, "password", "Password", [
        "labelClass" => "form-label",
        "inputClass" => "form-control"
    ]); ?>
</div>

<div class="form-check">
    <?= $form->checkboxField($model, "rememberMe", "Check me out", [
        "labelClass" => "form-check-label",
        "inputClass" => "form-check-input"
    ]); ?>
</div>
<div class="mb-3">
    <?= $form->submitField(name: "submit", label: "Sign In", option: [
        "class" => "form-control btn btn-primary"
    ]) ?>
</div>
<?php Form::end(); ?>

<span>If you don't have an account, you may <a href="/signUp" class="btn btn-link">sign up</a></span>