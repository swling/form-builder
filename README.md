# Dynamic Bulma form builder

```php

echo "
    <!DOCTYPE html>
    <head>
    <link rel='stylesheet' href='//cdn.jsdelivr.net/npm/bulma@0.7.4/css/bulma.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='//cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.7.2/css/all.min.css' type='text/css' media='all' />
    <style>span.required{color:#F00} body{padding:50px;}</style>
    <title>PHP bulma Form builder Demo</title>
    </head>
    <body>
    "
;

// 输出结果
if (!empty($_POST)) {
	print_r($_POST);
}

require "class-wnd-form.php";

$form = new Wnd_Form();

$form->add_html('<div class="field"><div class="ajax-msg"></div></div>');

// input
$form->add_text(
	array(
		'name' => 'user_name',
		'value' => '',
		'placeholder' => 'user name',
		'label' => 'User name<span class="required">*</span>',
		'has_icons' => 'left', //icon position "left" orf "right"
		'icon' => '<i class="fas fa-user"></i>', // icon html @link https://fontawesome.com/
		'autofocus' => 'autofocus',
		'required' => true,
	)
);

// input
$form->add_email(
	array(
		'name' => 'email',
		'value' => '',
		'placeholder' => 'email',
		'label' => 'Email <span class="required">*</span>',
		'has_icons' => 'left',
		'icon' => '<i class="fas fa-envelope"></i>',
		'required' => false,
	)
);

// password
$form->add_password(
	array(
		'name' => 'password',
		'value' => '',
		'label' => 'Password <span class="required">*</span>',
		'placeholder' => 'password',
		'has_icons' => 'left',
		'icon' => '<i class="fas fa-unlock-alt"></i>',
		'required' => false,
	)
);

// html
$form->add_html('<div class="field is-horizontal"><div class="field-body">');

// radio
$form->add_Radio(
	array(
		'name' => 'radio',
		'value' => array('key1' => 'value1', 'key2' => 'value2'),
		'label' => 'SEX',
		'required' => false,
		'checked' => 'woman', //default checked value
	)
);

$form->add_html('</div></div>');

// dropdown
$form->add_dropdown(
	array(
		'name' => 'dropdown',
		'options' => array('select1' => 'value1', 'select2' => 'value2'),
		'label' => 'Dropdown',
		'required' => false,
		'checked' => 'value2', //default checked value
	)
);

// checkbox
$form->add_checkbox(
	array(

		'name' => 'checkbox',
		'value' => array('key1' => 'value1', 'key2' => 'value2', 'key3' => 'value3'),
		'label' => 'checkbox',
		'checked' => 'value3', //default checked value
	)
);

// upload image
$form->add_image_upload(
	array(
		'id' => 'image-upload',
		'name' => 'file', // file input field name
		'label' => 'Image upload',
		'thumbnail' => 'https://www.baidu.com/img/baidu_jgylogo3.gif', // default thumbnail image url, maybe replace this after ajax uploaded
		'thumbnail_size' => array('width' => 100, 'height' => 100), //thumbnail image size
		'file_id' => 10, //data-file-id on delete button，in some situation, you want delete the file
		'hidden_input' => array( // some hidden input,maybe useful in ajax upload
			'meta_key' => 'avatar',
			'save_width' => '0',
			'save_hight' => '0',
		),
	)
);

// upload file
$form->add_file_upload(
	array(
		'id' => 'file-upload',
		'name' => 'file', // file input field name
		'label' => 'File upland',
		'file_name' => 'file name',
		'file_id' => 0, //data-file-id on delete button，in some situation, you want delete the file
		'hidden_input' => array('meta_key' => 'file'), // some hidden input,maybe useful in ajax upload
	)
);

// textarea
$form->add_textarea(
	array(
		'name' => 'content',
		'label' => 'content',
		'placeholder' => 'placeholder content',
		'required' => true,
	)
);

$form->add_action('POST', '');
$form->set_form_attr('id="my-form-id"');
$form->add_submit_button('Submit', 'is-primary');

$form->build();

echo $form->html;


echo '</body>';
echo '</html>';

```

[1]: https://bulma.io
[2]: https://fontawesome.com
[3]: https://wndwp.com
