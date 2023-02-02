<h1>Sign Up</h1>

<?php

use app\core\form\Form;

$this->title = "Sign Up";

$form = Form::begin('', 'post'); ?>

<div class="form-group">
    <?= $form->textField($model, "fullname", "Fullname"); ?>
</div>

<div class="form-group">
    <?= $form->emailField($model, "email", "Email"); ?>
</div>

<div class="form-group">
    <?= $form->textField($model, "username", "Username"); ?>
</div>

<div class="form-group row">
    <div class="col-6">
        <?= $form->passwordField($model, "password", "Password"); ?>
    </div>
    <div class="col-6">
        <?= $form->passwordField($model, "confirmPassword", "Confirm Password"); ?>
    </div>
</div>
<br>

<div class="mb-3">
    <?= $form->submitField(name: "submit", label: "Sign Up") ?>
</div>
<?php Form::end(); ?>
<span>If you already have an account, you may <a href="/signIn" class="btn btn-link">sign in</a></span>