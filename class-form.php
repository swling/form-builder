<?php

/**
 * Class for creating dynamic Bulma forms.
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
		'icon' => '<i class="fas fa-user"></i>',
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
			'has-icons' => $args['has-icons'],
			'icon' => $args['icon'],
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

	// Switch (custom, see https://wikiki.github.io/form/switch/)
	// The id is related to how the switch should look like. For instance, you can pass 'switchThinColorInfo'
	// in order to display a thin switch with info color. See documentation for details.
	function addSwitch($args) {

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
	function addImageUpload($name, $label) {
		array_push($this->input_values, array(
			'type' => "image",
			'name' => $args['name'],
			'placeholder' => NULL,
			'label' => $args['label'],
			'checked' => NULL,
			'value' => NULL,
			'required' => NULL,
			'options' => NULL,
			'id' => NULL,
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
		foreach ($this->input_values as $inputValue) {
			switch ($inputValue['type']) {
			case 'text':
			case 'email':
			case 'password':
				$html .= $this->build_input($inputValue);
				break;
			case 'radio':
				$html .= $this->build_radio($inputValue);
				break;
			case 'checkbox':
				$html .= $this->build_checkbox($inputValue);
				break;
			case 'dropdown':
				$html .= $this->build_dropdown($inputValue);
				break;
			case 'image':
				$html .= $this->buildImage($inputValue);
				break;
			case 'tinymce':
				$html .= $this->buildTinyMCE($inputValue);
				break;
			case 'textarea':
				$html .= $this->build_textarea($inputValue);
				break;
			case 'switch':
				$html .= $this->build_switch($inputValue);
				break;
			case 'html':
				$html .= $this->build_html($inputValue);
				break;
			default:
				break;
			}
		}
		$this->html .= $html;
	}

	private function build_dropdown($inputValue) {
		$html = '<div class="field">';
		if (!empty($inputValue['label'])) {
			$html .= '<label class="label">' . $inputValue['label'] . '</label>';
		}
		$html .= '<div class="control">';
		$html .= '<div class="select">';
		$html .= '<select name="' . $inputValue['name'] . '" ' . $this->get_required($inputValue) . ' >';
		foreach ($inputValue['options'] as $key => $value) {
			$checked = ($inputValue['checked'] == $value) ? ' selected="selected"' : '';
			$html .= '<option value="' . $value . '"' . $checked . '>' . $key . '</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		return $html;
	}

	private function build_radio($inputValue) {

		$html = '<div class="field">';
		$html .= '<div class="control">';
		foreach ($inputValue['value'] as $key => $value) {
			$html .= '<label class="radio">';
			$html .= '<input type="radio" name="' . $inputValue['name'] . '" value="' . $value . '" ' . $this->get_required($inputValue);
			$html .= ($inputValue['checked'] == $value) ? ' checked="checked" >' : ' >';
			$html .= ' ' . $key;
			$html .= '</label>';
		}unset($key, $value);
		$html .= '</div>';
		$html .= '</div>';

		return $html;

	}

	private function build_input($inputValue) {
		$html = '<div class="field">';
		if (!empty($inputValue['label'])) {
			$html .= '<label class="label">' . $inputValue['label'] . '</label>';
		}

		// input icon
		if ($inputValue['has-icons']) {

			$html .= '<div class="control has-icons-' . $inputValue['has-icons'] . '">';
			$html .= '<input class="input ' . $this->get_size() . '" name="' . $inputValue['name'] . '" type="' . $inputValue['type'] . '" placeholder="' . $inputValue['placeholder']
			. '" autofocus="" value="' . $this->get_value($inputValue) . '" ' . $this->get_required($inputValue) . '>';
			$html .= '<span class="icon is-small is-' . $inputValue['has-icons'] . '">' . $inputValue['icon'] . '</span>';
			$html .= '</div>';

		} else {

			$html .= '<div class="control">';
			$html .= '<input class="input ' . $this->get_size() . '" name="' . $inputValue['name'] . '" type="' . $inputValue['type'] . '" placeholder="' . $inputValue['placeholder']
			. '" autofocus="" value="' . $this->get_value($inputValue) . '" ' . $this->get_required($inputValue) . '>';
			$html .= '</div>';
		}

		$html .= '</div>';
		return $html;
	}

	private function build_checkbox($inputValue) {

		$html = '<div class="field">';
		$html .= '<div class="control">';
		foreach ($inputValue['value'] as $key => $value) {
			$html .= '<label class="checkbox">';
			$html .= '<input type="checkbox" name="' . $inputValue['name'] . '[]" value="' . $value . '" ' . $this->get_required($inputValue);
			$html .= ($inputValue['checked'] == $value) ? ' checked="checked" >' : ' >';
			$html .= ' ' . $key;
			$html .= '</label>&nbsp;&nbsp;';
		}unset($key, $value);
		$html .= '</div>';
		$html .= '</div>';

		return $html;

	}

	private function buildImage($inputValue) {
		$html .= '<div class="file" style="margin-bottom:10px;">';
		$html .= '<label class="file-label">';
		$html .= '<input class="file-input" type="file" name="' . $inputValue['name'] . '" accept="image/*"/>';
		$html .= '<span class="file-cta">';
		$html .= '<span class="file-icon">';
		$html .= '<i class="fas fa-cloud-upload-alt"></i>';
		$html .= '</span>';
		$html .= '<span class="file-label">' . $inputValue['label'] . '</span>';
		$html .= '</span>';
		$html .= '</label>';
		$html .= '</div>';
		return $html;
	}

	private function build_html($inputValue) {
		return $inputValue['value'];
	}

	private function build_switch($inputValue) {
		$html = '<div class="field">';
		$checked = $inputValue['checked'] ? 'checked="checked"' : '';
		$id = $inputValue['id'];
		$html .= '<input id="' . $id . '" type="checkbox" name="' . $inputValue['name'] . '" class="switch" ' . $checked . '">';
		$html .= '<label for="' . $id . '">' . $inputValue['label'] . '</label>';
		$html .= '</div>';
		return $html;
	}

	private function build_textarea($inputValue) {

		$html = '<div class="field">';
		if (!empty($inputValue['label'])) {
			$html .= '<label class="label">' . $inputValue['label'] . '</label>';
		}
		$html .= '<textarea class="textarea" name="' . $inputValue['name'] . '" ' . $this->get_required($inputValue) . ' placeholder="' . $inputValue['placeholder'] . '" ></textarea>';
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

	private function get_value($inputValue) {
		$value = $inputValue['value'];
		if (empty($value)) {
			return '';
		}
		return $value;
	}

	private function get_required($inputValue) {
		$isRequired = $inputValue['required'];
		if ($isRequired) {
			return 'required="required"';
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
}
