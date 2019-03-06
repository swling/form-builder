# Dynamic Bulma form builder for the Fatfree framework

```php

require "class-form.php";

$form = new Wnd_form();

// input
$form->addText(
	array(
		'name' => 'user_name',
		'value' => '',
		'placeholder' => 'user name',
		'label' => 'User name<span class="required">*</span>',
		'has-icons' => 'left', //icon position "left" orf "right"
		'icon' => '<i class="fas fa-user"></i>', // icon html @link https://fontawesome.com/
		'required' => true,
	)
);

// input
$form->addEmail(
	array(
		'name' => 'email',
		'value' => '',
		'placeholder' => 'email',
		'label' => 'Email <span class="required">*</span>',
		'has-icons' => 'left',
		'icon' => '<i class="fas fa-envelope"></i>',
		'required' => false,
	)
);

// password
$form->addPassword(
	array(
		'name' => 'password',
		'value' => '',
		'label' => 'Password <span class="required">*</span>',
		'placeholder' => 'password',
		'has-icons' => 'left',
		'icon' => '<i class="fas fa-unlock-alt"></i>',
		'required' => false,
	)
);

// html
$form->addHtml('<div class="field is-horizontal"><div class="field-body">');

// radio
$form->addRadio(
	array(
		'name' => 'radio',
		'value' => array('key1' => 'value1', 'key2' => 'value2'),
		'label' => 'SEX',
		'required' => false,
		'checked' => 'woman', //default checked value
	)
);

$form->addHtml('</div></div>');

// dropdown
$form->addDropdown(
	array(
		'name' => 'dropdown',
		'options' => array('select1' => 'value1', 'select2' => 'value2'),
		'label' => 'Dropdown',
		'required' => false,
		'checked' => 'value2', //default checked value
	)
);

// checkbox
$form->addCheckbox(
	array(

		'name' => 'checkbox',
		'value' => array('key1' => 'value1', 'key2' => 'value2', 'key3' => 'value3'),
		'label' => 'checkbox',
		'checked' => 'value3', //default checked value
	)
);

// textarea
$form->addTextarea(
	array(
		'name' => 'content',
		'label' => 'content',
		'placeholder' => 'placeholder content',
		'required' => true,
	)
);

$form->addAction('POST', '');
$form->setFormAttr('id="my-form-id"');
$form->addSubmitButton('Submit', 'is-primary');

$form->build();

echo $form->html;
```

[1]: https://bulma.io
[2]: https://fontawesome.com
[3]: https://wndwp.com
