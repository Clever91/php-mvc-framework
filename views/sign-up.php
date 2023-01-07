<h1>Sign Up</h1>

<?php

use app\core\form\Form;

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

<div class="form-group">
    <div class="col">
        <?= $form->passwordField($model, "password", "Password"); ?>
    </div>
    <div class="col">
        <?= $form->passwordField($model, "confirmPassword", "Confirm Password"); ?>
    </div>
</div>

<div class="form-group">
    <button class="btn btn-primary pull-right" name="submit" type="submit">Register</button>
</div>
<?php Form::end(); ?>

<!-- <form action="" method="post">
    <div class="mb-3">
        <label class="form-label">Fullname</label>
        <input name="fullname" type="text" class="form-control" placeholder="Enter fullname is here...">
    </div>
    <div class="mb-3">
        <label class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input name="username" type="text" class="form-control" placeholder="Enter username here...">
    </div>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input name="confirmPassword" type="password" class="form-control">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button class="form-control btn btn-primary" name="submit" type="submit">Send Us</button>
    </div>
</form> -->
<span>If you already have an account, you may <a href="/signIn" class="btn btn-link">sign in</a></span>