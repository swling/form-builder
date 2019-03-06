<?php

echo "<!DOCTYPE html><link rel='stylesheet' href='//cdn.jsdelivr.net/npm/bulma@0.7.4/css/bulma.min.css' type='text/css' media='all' />";
echo "<link rel='stylesheet' href='//cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.7.2/css/all.min.css' type='text/css' media='all' />";
echo "
    <head>
    <style>span.required{color:#F00} body{padding:50px;}</style>
    <title>PHP bulma Form builder Demo</title>
    </head>
";

require "class-form.php";

$form = new Wnd_form();

// input
$form->addText(
	array('name' => 'user_name',
		'value' => 'value',
		'placeholder' => 'user name',
		'label' => 'User name<span class="required">*</span>',
		'has-icons' => 'left', //icon position "left" orf "right"
		'icon' => '<i class="fas fa-user"></i>', // icon html @link https://fontawesome.com/
		'required' => true,
	)
);

// input
$form->addEmail(
	array('name' => 'email',
		'value' => '',
		'placeholder' => 'email',
		'label' => '电子邮件',
		'has-icons' => 'left',
		'icon' => '<i class="fas fa-user"></i>',
		'required' => false,
	)
);

// password
$form->addPassword(
	array('name' => 'text',
		'value' => '测试值2',
		'label' => 'label2<span></span>',
		'placeholder' => 'password',
		'has-icons' => 'left',
		'icon' => '<i class="fas fa-key"></i>',
		'required' => false,
	)
);

// html
$form->addHtml('<div class="field is-horizontal"><div class="field-body">');

// radio
$form->addRadio(
	array(
		'name' => 'radio',
		'value' => array('key' => 'value', '测试值3' => 'demo3'),
		'label' => '性别',
		'required' => false,
		'checked' => 'demo3', //default checked value
	)
);

$form->addHtml('</div></div>');

// dropdown
$form->addDropdown(
	array(
		'name' => 'dropdown',
		'options' => array('测试值3' => 'value1', '测试值2' => 'value2'),
		'label' => 'label3',
		'required' => 1,
		'checked' => 'value2', //default checked value
	)
);

// checkbox
$form->addCheckbox(
	array(

		'name' => 'aihao',
		'value' => array('key1' => 'value1', 'key2' => 'value2', 'key3' => 'value3'),
		'label' => 'checkbox',
		'required' => 1,
		'checked' => 'value3', //default checked value
	)
);

// textarea
$form->addTextarea(
	array(
		'name' => 'dropdown',
		'label' => 'label3',
		'required' => 1,
	)
);

$form->addAction('POST', '');
$form->addSubmitButton('Submit', 'is-primary');

$form->build();

echo $form->html;
