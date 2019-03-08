<?php

/**
 * Class for creating dynamic Bulma forms.
 *@since 2019.03
 *@link https://github.com/swling/form-builder
 *@link https://wndwp.com
 *contact: tangfou@gmail.com
 */
class Wnd_Form {

	private $form_attr;

	private $input_values = array();

	private $submit;

	private $submit_style;

	private $action;

	private $method;

	public $html;

	private $size;

	private $upload;

	static private $defaults = array(
		'name' => 'name',
		'placeholder' => 'placeholder',
		'label' => 'label',
		'checked' => '',
		'value' => 'value',
		'required' => '',
		'options' => NULL,
		'has-icons' => NULL,
		'icon' => '',
		'autofocus' => '',
		'id' => NULL,

	);

	// 允许外部更改私有变量
	function __set($var, $val) {
		$this->$var = $val;
	}

	// _text
	function add_text($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->input_values, array(
			'type' => 'text',
			'name' => $args['name'],
			'placeholder' => $args['placeholder'],
			'label' => $args['label'],
			'value' => $args['value'],
			'required' => $args['required'],
			'autofocus' => $args['autofocus'],
			'has-icons' => $args['has-icons'],
			'icon' => $args['icon'],
			'id' => NULL,
		));
	}

	// _text
	function add_hidden($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->input_values, array(
			'type' => 'hidden',
			'name' => $args['name'],
			'value' => $args['value'],
			'id' => NULL,
		));
	}

	// _text
	function add_textarea($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->input_values, array(
			'type' => 'textarea',
			'name' => $args['name'],
			'placeholder' => $args['placeholder'],
			'label' => $args['label'],
			'value' => $args['value'],
			'required' => $args['required'],
			'id' => NULL,
		));
	}

	function add_email($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->input_values, array(
			'type' => 'email',
			'name' => $args['name'],
			'placeholder' => $args['placeholder'],
			'label' => $args['label'],
			'value' => $args['value'],
			'required' => $args['required'],
			'autofocus' => $args['autofocus'],
			'has-icons' => $args['has-icons'],
			'icon' => $args['icon'],
			'id' => NULL,
		));
	}

	// _password
	function add_password($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->input_values, array(
			'type' => "password",
			'name' => $args['name'],
			'placeholder' => $args['placeholder'],
			'label' => $args['label'],
			'value' => $args['value'],
			'required' => $args['required'],
			'autofocus' => $args['autofocus'],
			'has-icons' => $args['has-icons'],
			'icon' => $args['icon'],
			'id' => NULL,
		));
	}

	// _dropdown
	function add_dropdown($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->input_values, array(
			'type' => "dropdown",
			'name' => $args['name'],
			'label' => $args['label'],
			'checked' => $args['checked'],
			'required' => $args['required'],
			'options' => $args['options'],
			'id' => NULL,
		));
	}

	// _radio
	function add_radio($args) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->input_values, array(
			'type' => "radio",
			'name' => $args['name'],
			'placeholder' => $args['placeholder'],
			'label' => $args['label'],
			'checked' => $args['checked'],
			'value' => $args['value'],
			'required' => $args['required'],
			'options' => NULL,
			'id' => NULL,
		));
	}

	// _checkbox
	function add_checkbox($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->input_values, array(
			'type' => "checkbox",
			"name" => $args['name'],
			'label' => $args['label'],
			'checked' => $args['checked'],
			'value' => $args['value'],
			'required' => $args['required'],
			'id' => NULL,
		));
	}

	// _switch (custom, see https://wikiki.github.io/form/switch/)
	// The id is related to how the switch should look like. For instance, you can pass 'switchThinColorInfo'
	// in order to display a thin switch with info color. See documentation for details.
	function add_switch($args) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->input_values, array(
			'type' => "switch",
			'name' => $args['name'],
			'placeholder' => NULL,
			'label' => $args['label'],
			'checked' => $args['checked'],
			'value' => NULL,
			'required' => NULL,
			'options' => NULL,
			'id' => $args['id'],
			// 'is-public' => NULL,
		));
	}

	// TinyMCE textarea
	function addTinyMCE($name, $placeholder, $label, $isPublic) {
		array_push($this->input_values, array(
			'type' => "tinymce",
			'name' => $args['name'],
			'placeholder' => $args['placeholder'],
			'label' => $args['label'],
			'checked' => NULL,
			'value' => NULL,
			'required' => NULL,
			'options' => NULL,
			'id' => NULL,
			'is-public' => $args['isPublic'],
		));
	}

	// Submit
	function add_submit_button($label, $submit_style) {
		$this->submit = $label;
		$this->submit_style = $submit_style;
	}

	// _action
	function add_action($method, $action) {
		$this->method = $method;
		$this->action = $action;
	}

	// Image upload
	function add_image_upload($args) {

		$defaults = array(
			'name' => 'file',
			'label' => 'Image upland',
			'thumbnail' => '',
			'thumbnail-size' => array('height' => '100', 'width' => '100'),
			'required' => null,
			'file-id' => 0,
			'hidden-input' => array(),
			'id' => 'image-upload-field',
		);
		$args = array_merge($defaults, $args);

		array_push($this->input_values, array(
			'type' => "image",
			'name' => $args['name'],
			'label' => $args['label'],
			'thumbnail' => $args['thumbnail'],
			'thumbnail-size' => $args['thumbnail-size'],
			'required' => $args['required'],
			'file-id' => $args['file-id'],
			'hidden-input' => $args['hidden-input'],
			'id' => $args['id'],
		));
		if (!$this->upload) {
			$this->upload = true;
		}

	}

	// Image upload
	function add_file_upload($args) {

		$defaults = array(
			'name' => 'file',
			'label' => 'File upload',
			'file-name' => 'file name',
			'file-id' => 0,
			'hidden-input' => array(),
			'required' => null,
			'id' => 'file-upload-field',
		);
		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->input_values, array(
			'type' => "file",
			'name' => $args['name'],
			'label' => $args['label'],
			'file-name' => $args['file-name'],
			'file-id' => $args['file-id'],
			'hidden-input' => $args['hidden-input'],
			'required' => $args['required'],
			'id' => $args['id'],
		));
		if (!$this->upload) {
			$this->upload = true;
		}

	}

	/**
	 *@since 2019.03.06 在表单当前位置插入指定html代码以补充现有方法无法实现的效果
	 */
	function add_html($html) {
		array_push($this->input_values, array(
			'type' => 'html',
			'value' => $html,
		));
	}

	// _size (e.g. 'is-large', 'is-small')
	function set_size($size) {
		$this->size = $size;
	}

	/**
	 *@since 2019.03.06
	 *表单构造函数
	 **/
	function build() {
		$this->build_form_header();
		$this->build_input_values();
		$this->build_submit_button();
		$this->build_form_footer();
	}

	private function build_form_header() {
		$html = '<form';
		if (!is_null($this->method)) {
			$html .= ' method="' . $this->method . '"';
		}
		if (!is_null($this->action)) {
			$html .= ' action="' . $this->action . '"';
		}
		if ($this->upload) {
			$html .= ' enctype="multipart/form-data"';
		}

		if ($this->form_attr) {
			$html .= ' ' . $this->form_attr;
		}
		$html .= '>';
		$this->html = $html;
	}

	private function build_input_values() {
		$html = '';
		foreach ($this->input_values as $input_value) {
			switch ($input_value['type']) {
			case 'text':
			case 'email':
			case 'password':
				$html .= $this->build_input($input_value);
				break;
			case 'hidden':
				$html .= $this->build_hidden($input_value);
				break;
			case 'radio':
				$html .= $this->build_radio($input_value);
				break;
			case 'checkbox':
				$html .= $this->build_checkbox($input_value);
				break;
			case 'dropdown':
				$html .= $this->build_dropdown($input_value);
				break;
			case 'image':
				$html .= $this->build_image_upload($input_value);
				break;
			case 'file':
				$html .= $this->build_file_upload($input_value);
				break;
			case 'tinymce':
				$html .= $this->buildTinyMCE($input_value);
				break;
			case 'textarea':
				$html .= $this->build_textarea($input_value);
				break;
			case 'switch':
				$html .= $this->build_switch($input_value);
				break;
			case 'html':
				$html .= $this->build_html($input_value);
				break;
			default:
				break;
			}
		}
		$this->html .= $html;
	}

	private function build_dropdown($input_value) {
		$html = '<div class="field">';
		if (!empty($input_value['label'])) {
			$html .= '<label class="label">' . $input_value['label'] . '</label>';
		}
		$html .= '<div class="control">';
		$html .= '<div class="select">';
		$html .= '<select name="' . $input_value['name'] . '"' . $this->get_required($input_value) . ' >';
		foreach ($input_value['options'] as $key => $value) {
			$checked = ($input_value['checked'] == $value) ? ' selected="selected"' : '';
			$html .= '<option value="' . $value . '"' . $checked . '>' . $key . '</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		return $html;
	}

	private function build_radio($input_value) {

		$html = '<div class="field">';
		$html .= '<div class="control">';
		foreach ($input_value['value'] as $key => $value) {
			$html .= '<label class="radio">';
			$html .= '<input type="radio" name="' . $input_value['name'] . '" value="' . $value . '"' . $this->get_required($input_value);
			$html .= ($input_value['checked'] == $value) ? ' checked="checked" >' : ' >';
			$html .= ' ' . $key;
			$html .= '</label>';
		}unset($key, $value);
		$html .= '</div>';
		$html .= '</div>';

		return $html;

	}

	private function build_hidden($input_value) {

		$html = '<input name="' . $input_value['name'] . '" type="' . $input_value['type'] . '" value="' . $this->get_value($input_value) . '" >';

		return $html;
	}

	private function build_input($input_value) {
		$html = '<div class="field">';
		if (!empty($input_value['label'])) {
			$html .= '<label class="label">' . $input_value['label'] . '</label>';
		}

		// input icon
		if ($input_value['has-icons']) {

			$html .= '<div class="control has-icons-' . $input_value['has-icons'] . '">';
			$html .= '<input class="input ' . $this->get_size() . '" name="' . $input_value['name'] . '" type="' . $input_value['type'] . '" placeholder="' . $input_value['placeholder'] . '"' . $this->get_autofocus($input_value) . ' value="' . $this->get_value($input_value) . '"' . $this->get_required($input_value) . '>';
			$html .= '<span class="icon ' . $this->get_size() . ' is-' . $input_value['has-icons'] . '">' . $input_value['icon'] . '</span>';
			$html .= '</div>';

		} else {

			$html .= '<div class="control">';
			$html .= '<input class="input ' . $this->get_size() . '" name="' . $input_value['name'] . '" type="' . $input_value['type'] . '" placeholder="' . $input_value['placeholder']
			. '"' . $this->get_autofocus($input_value) . ' value="' . $this->get_value($input_value) . '"' . $this->get_required($input_value) . '>';
			$html .= '</div>';
		}

		$html .= '</div>';
		return $html;
	}

	private function build_checkbox($input_value) {

		$html = '<div class="field">';
		$html .= '<div class="control">';
		foreach ($input_value['value'] as $key => $value) {
			$html .= '<label class="checkbox">';
			$html .= '<input type="checkbox" name="' . $input_value['name'] . '[]" value="' . $value . '"' . $this->get_required($input_value);
			$html .= ($input_value['checked'] == $value) ? ' checked="checked" >' : ' >';
			$html .= ' ' . $key;
			$html .= '</label>&nbsp;&nbsp;';
		}unset($key, $value);
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

	private function build_image_upload($input_value) {

		$html = '<div ' . $this->get_id($input_value) . ' class="field">';

		$html .= '<div class="field">';
		$html .= '<a><img src="' . $input_value['thumbnail'] . '" height="' . $input_value['thumbnail-size']['height'] . '" width="' . $input_value['thumbnail-size']['height'] . '"></a>';
		$html .= '<a class="delete" data-id="' . $input_value['id'] . '" data-file-id="' . $input_value['file-id'] . '"></a>';
		$html .= '<div class="file">';
		$html .= '<input type="file" class="file-input" name="' . $input_value['name'] . '[]' . '" accept="image/*" data-id="' . $input_value['id'] . '">';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

		foreach ($input_value['hidden-input'] as $key => $value) {
			$html .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
		}

		$html .= '
		<script type="text/javascript">
		    window.onload = function () {
		        var fileupload = document.querySelector("#' . $input_value['id'] . ' input[type=\'file\']");
		        var image = document.querySelector("#' . $input_value['id'] . ' img");
		        image.onclick = function () {
		            fileupload.click();
		        };
		    };
		</script>';

		return $html;
	}

	private function build_file_upload($input_value) {

		$html = '<div ' . $this->get_id($input_value) . ' class="field">';
		$html .= '<div class="columns is-mobile">';

		$html .= '<div class="column">';
		$html .= '<div class="file has-name is-fullwidth">';
		$html .= '<label class="file-label">';
		$html .= '<input type="file" class="file-input" name="' . $input_value['name'] . '[]' . '" data-id="' . $input_value['id'] . '" />';
		$html .= '<span class="file-cta">';
		$html .= '<span class="file-icon"><i class="fa fa-upload"></i></span>';
		$html .= '<span class="file-label">' . $input_value['label'] . '</span>';
		$html .= '</span>';
		$html .= '<span class="file-name">' . $input_value['file-name'] . '</span>';
		$html .= '</label>';
		$html .= '</div>';
		$html .= '</div>';

		$html .= '<div class="column is-narrow">';
		$html .= '<a class="delete" data-id="' . $input_value['id'] . '" data-file-id="' . $input_value['file-id'] . '"></a>';
		$html .= '</div>';

		$html .= '</div>';

		foreach ($input_value['hidden-input'] as $key => $value) {
			$html .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
		}

		$html .= '</div>';
		return $html;
	}

	private function build_html($input_value) {
		return $input_value['value'];
	}

	private function build_switch($input_value) {
		$html = '<div class="field">';
		$checked = $input_value['checked'] ? 'checked="checked"' : '';
		$id = $input_value['id'];
		$html .= '<input id="' . $id . '" type="checkbox" name="' . $input_value['name'] . '" class="switch" ' . $checked . '">';
		$html .= '<label for="' . $id . '">' . $input_value['label'] . '</label>';
		$html .= '</div>';
		return $html;
	}

	private function build_textarea($input_value) {

		$html = '<div class="field">';
		if (!empty($input_value['label'])) {
			$html .= '<label class="label">' . $input_value['label'] . '</label>';
		}
		$html .= '<textarea class="textarea" name="' . $input_value['name'] . '"' . $this->get_required($input_value) . ' placeholder="' . $input_value['placeholder'] . '" ></textarea>';
		$html .= '</div>';
		return $html;
	}

	private function build_submit_button() {
		if (is_null($this->submit)) {
			$submit = Base::instance()->get('form.submit_label_default');
		} else {
			$submit = $this->submit;
		}
		$this->html .= '<button type="submit" value="upload" class="button ' . $this->submit_style . ' ' . $this->get_size() . '">' . $submit . '</button>';
	}

	private function build_form_footer() {
		$this->html .= '</form>';
	}

	private function get_value($input_value) {
		if (empty($input_value['value'])) {
			return '';
		}
		return $value;
	}

	private function get_required($input_value) {
		if ($input_value['required']) {
			return ' required="required"';
		}
		return '';
	}

	private function get_id($input_value) {
		if ($input_value['id']) {
			return ' id="' . $input_value['id'] . '"';
		}
		return '';
	}

	private function get_autofocus($input_value) {
		if ($input_value['autofocus']) {
			return ' autofocus="autofocus"';
		}
		return '';
	}

	private function get_size() {
		$size = $this->size;
		return $size;
	}

	/**
	 *@since 2019.03.06 给表头添加额自定义属性
	 */
	public function set_form_attr($form_attr) {
		$this->form_attr = $form_attr;
	}

	public function the_form_data() {
		print_r($this->input_values);
	}
}
