<h1>Contact</h1>
<?php

use cleveruz\phpmvc\form\Form;

$this->title = "Contact";

$form = Form::begin(action: '/contact', method: 'post'); ?>
<div class="mb-3">
    <div class="form-group">
        <?= $form->textField($model, "subject", "Subject") ?>
    </div>
</div>
<div class="mb-3">
    <div class="form-group">
        <?= $form->textField($model, "email", "Email") ?>
    </div>
</div>
<div class="mb-3">
    <div class="form-group">
        <?= $form->textareaField($model, "body", "Body") ?>
    </div>
</div>
<div class="mb-3">
    <div class="form-group">
        <?= $form->submitField("send", "Send Us") ?>
    </div>
</div>
<?php Form::end();  ?>