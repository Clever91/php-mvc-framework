<h1>Sign Up</h1>

<?php

use app\core\form\Form;

$form = Form::begin('', 'post'); ?>

<div class="form-group">
    <?= $form->textField($model, "fullname", "Fullname", [
        "labelClass" => "form-label",
        "inputClass" => "form-control"
    ]); ?>
</div>

<div class="form-group">
    <?= $form->emailField($model, "email", "Email", [
        "labelClass" => "form-label",
        "inputClass" => "form-control"
    ]); ?>
</div>

<div class="form-group">
    <?= $form->textField($model, "username", "Username", [
        "labelClass" => "form-label",
        "inputClass" => "form-control"
    ]); ?>
</div>

<div class="form-group row">
    <div class="col-6">
        <?= $form->passwordField($model, "password", "Password", [
            "labelClass" => "form-label",
            "inputClass" => "form-control"
        ]); ?>
    </div>
    <div class="col-6">
        <?= $form->passwordField($model, "confirmPassword", "Confirm Password", [
            "labelClass" => "form-label",
            "inputClass" => "form-control"
        ]); ?>
    </div>
</div>
<br>

<div class="mb-3">
    <?= $form->submitField(name: "submit", label: "Sign Up", option: [
        "class" => "form-control btn btn-primary"
    ]) ?>
</div>
<?php Form::end(); ?>
<span>If you already have an account, you may <a href="/signIn" class="btn btn-link">sign in</a></span>