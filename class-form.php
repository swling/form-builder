<?php

/**
 * Class for creating dynamic Bulma forms.
 */
class Wnd_form {

	private $inputValues = array();

	private $submit;

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

	// Text
	function addText($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->inputValues, array(
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

	// Text
	function addTextarea($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->inputValues, array(
			'type' => 'textarea',
			'name' => $args['name'],
			'placeholder' => $args['placeholder'],
			'label' => $args['label'],
			'value' => $args['value'],
			'required' => $args['required'],
			'id' => NULL,
		));
	}

	function addEmail($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->inputValues, array(
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

	// Password
	function addPassword($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->inputValues, array(
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

	// Dropdown
	function addDropdown($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->inputValues, array(
			'type' => "dropdown",
			'name' => $args['name'],
			'label' => $args['label'],
			'checked' => $args['checked'],
			'required' => $args['required'],
			'options' => $args['options'],
			'id' => NULL,
		));
	}

	// Radio
	function addRadio($args) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->inputValues, array(
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

	// Checkbox
	function addCheckbox($args = array()) {

		$args = array_merge(Wnd_form::$defaults, $args);

		array_push($this->inputValues, array(
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

		array_push($this->inputValues, array(
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
		array_push($this->inputValues, array(
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
	function addSubmitButton($label, $additionalStyling) {
		$this->submit = $label;
		$this->additionalSubmitStyling = $additionalStyling;
	}

	// Action
	function addAction($method, $action) {
		$this->method = $method;
		$this->action = $action;
	}

	// Image upload
	function addImageUpload($name, $label) {
		array_push($this->inputValues, array(
			'type' => "image",
			'name' => $args['name'],
			'placeholder' => NULL,
			'label' => $args['label'],
			'checked' => NULL,
			'value' => NULL,
			'required' => NULL,
			'options' => NULL,
			'id' => NULL,
			// 'is-public' => NULL,
		));
		if (!$this->upload) {
			$this->upload = true;
		}

	}

	/**
	 *@since 2019.03.06 在表单当前位置插入指定html代码以补充现有方法无法实现的效果
	 */
	function addHtml($html) {
		array_push($this->inputValues, array(
			'type' => 'html',
			'value' => $html,
		));
	}

	// Size (e.g. 'is-large', 'is-small')
	function setSize($size) {
		$this->size = $size;
	}

	/**
	 *@since 2019.03.06
	 *表单构造函数
	 **/
	function build() {
		$this->buildFormHeader();
		$this->buildInputValues();
		$this->buildSubmitButton();
		$this->buildFormFooter();
	}

	private function buildFormHeader() {
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
		$html .= '>';
		$this->html = $html;
	}

	private function buildInputValues() {
		$html = '';
		foreach ($this->inputValues as $inputValue) {
			switch ($inputValue['type']) {
			case 'text':
			case 'email':
			case 'password':
				$html .= $this->buildDefaultInput($inputValue);
				break;
			case 'radio':
				$html .= $this->buildRadio($inputValue);
				break;
			case 'checkbox':
				$html .= $this->buildCheckbox($inputValue);
				break;
			case 'dropdown':
				$html .= $this->buildDropdown($inputValue);
				break;
			case 'image':
				$html .= $this->buildImage($inputValue);
				break;
			case 'tinymce':
				$html .= $this->buildTinyMCE($inputValue);
				break;
			case 'textarea':
				$html .= $this->buildTextarea($inputValue);
				break;
			case 'switch':
				$html .= $this->buildSwitch($inputValue);
				break;
			case 'html':
				$html .= $this->buildHtml($inputValue);
				break;
			default:
				break;
			}
		}
		$this->html .= $html;
	}

	private function buildDropdown($inputValue) {
		$html = '<div class="field">';
		if (!empty($inputValue['label'])) {
			$html .= '<label class="label">' . $inputValue['label'] . '</label>';
		}
		$html .= '<div class="control">';
		$html .= '<div class="select">';
		$html .= '<select name="' . $inputValue['name'] . '" ' . $this->getRequired($inputValue) . ' >';
		foreach ($inputValue['options'] as $key => $value) {
			$checked = ($inputValue['checked'] == $value) ? 'selected="selected"' : '';
			$html .= '<option value="' . $value . '"  ' . $checked . ' >' . $key . '</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		return $html;
	}

	private function buildRadio($inputValue) {

		$html = '<div class="field">';
		$html .= '<div class="control">';
		foreach ($inputValue['value'] as $key => $value) {
			$html .= '<label class="radio">';
			$html .= '<input type="radio" name="' . $inputValue['name'] . '" ' . $this->getRequired($inputValue);
			$html .= ($inputValue['checked'] == $value) ? ' checked="checked" >' : ' >';
			$html .= ' ' . $key;
			$html .= '</label>';
		}unset($key, $value);
		$html .= '</div>';
		$html .= '</div>';

		return $html;

	}

	private function buildDefaultInput($inputValue) {
		$html = '<div class="field">';
		if (!empty($inputValue['label'])) {
			$html .= '<label class="label">' . $inputValue['label'] . '</label>';
		}

		// input icon
		if ($inputValue['has-icons']) {

			$html .= '<div class="control has-icons-' . $inputValue['has-icons'] . '">';
			$html .= '<input class="input ' . $this->getSize() . '" name="' . $inputValue['name'] . '" type="' . $inputValue['type'] . '" placeholder="' . $inputValue['placeholder']
			. '" autofocus="" value="' . $this->getValue($inputValue) . '" ' . $this->getRequired($inputValue) . '>';
			$html .= '<span class="icon is-small is-' . $inputValue['has-icons'] . '">' . $inputValue['icon'] . '</span>';
			$html .= '</div>';

		} else {

			$html .= '<div class="control">';
			$html .= '<input class="input ' . $this->getSize() . '" name="' . $inputValue['name'] . '" type="' . $inputValue['type'] . '" placeholder="' . $inputValue['placeholder']
			. '" autofocus="" value="' . $this->getValue($inputValue) . '" ' . $this->getRequired($inputValue) . '>';
			$html .= '</div>';
		}

		$html .= '</div>';
		return $html;
	}

	private function buildCheckbox($inputValue) {

		$html = '<div class="field">';
		$html .= '<div class="control">';
		foreach ($inputValue['value'] as $key => $value) {
			$html .= '<label class="checkbox">';
			$html .= '<input type="checkbox" name="' . $inputValue['name'] . '" ' . $this->getRequired($inputValue);
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

	private function buildHtml($inputValue) {
		return $inputValue['value'];
	}

	private function buildSwitch($inputValue) {
		$html = '<div class="field">';
		$checked = $inputValue['checked'] ? 'checked="checked"' : '';
		$id = $inputValue['id'];
		$html .= '<input id="' . $id . '" type="checkbox" name="' . $inputValue['name'] . '" class="switch" ' . $checked . '">';
		$html .= '<label for="' . $id . '">' . $inputValue['label'] . '</label>';
		$html .= '</div>';
		return $html;
	}

	private function buildTextarea($inputValue) {

		$html = '<div class="field">';
		if (!empty($inputValue['label'])) {
			$html .= '<label class="label">' . $inputValue['label'] . '</label>';
		}
		$html .= '<textarea class="textarea" name="' . $inputValue['name'] . '" ' . $this->getRequired($inputValue) . 'placeholder="' . $inputValue['placeholder'] . '" ></textarea>';
		$html .= '</div>';
		return $html;
	}

	private function buildSubmitButton() {
		if (is_null($this->submit)) {
			$submit = Base::instance()->get('form.submit_label_default');
		} else {
			$submit = $this->submit;
		}
		$this->html .= '<br /><button type="submit" value="upload" class="button ' . $this->additionalSubmitStyling . ' ' . $this->getSize() . '">' . $submit . '</button>';
	}

	private function buildFormFooter() {
		$this->html .= '</form>';
	}

	private function getValue($inputValue) {
		$value = $inputValue['value'];
		if (empty($value)) {
			return '';
		}
		return $value;
	}

	private function getRequired($inputValue) {
		$isRequired = $inputValue['required'];
		if ($isRequired) {
			return 'required="required"';
		}
		return '';
	}

	private function getSize() {
		$size = $this->size;
		return $size;
	}
}
