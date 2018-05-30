<?php

/**
 * Class for creating dynamic Bulma forms.
 */
class Form {

    private $inputValues = array();

    private $submit;

    private $action;

    private $method;

    private $html;

    private $isHorizontal = false;

    private $customHiveKey;

    private $size;

    private $additionalSubmitStyling = '';

    private $upload;

    private $recaptcha;

    // Text
    function addText($name, $placeholder, $value, $disabled) {
        array_push($this->inputValues, array(
            "type" => "text",
            "name" => $name,
            "placeholder" => $placeholder,
            "label" => NULL,
            "checked" => NULL,
            "value" => $value,
            "disabled" => $disabled,
            "options" => NULL,
            "id" => NULL,
            "is-public" => NULL
        ));
    }

    function addTextWithLabel($name, $placeholder, $label, $value, $disabled) {
        array_push($this->inputValues, array(
            "type" => "text",
            "name" => $name,
            "placeholder" => $placeholder,
            "label" => $label,
            "checked" => NULL,
            "value" => $value,
            "disabled" => $disabled,
            "options" => NULL,
            "id" => NULL,
            "is-public" => NULL
        ));
    }

    // E-mail
    function addEmail($name, $placeholder, $value, $disabled) {
        array_push($this->inputValues, array(
            "type" => "email",
            "name" => $name,
            "placeholder" => $placeholder,
            "label" => NULL,
            "checked" => NULL,
            "value" => $value,
            "disabled" => $disabled,
            "options" => NULL,
            "id" => NULL,
            "is-public" => NULL
        ));
    }

    function addEmailWithLabel($name, $placeholder, $label, $value, $disabled) {
        array_push($this->inputValues, array(
            "type" => "email",
            "name" => $name,
            "placeholder" => $placeholder,
            "label" => $label,
            "checked" => NULL,
            "value" => $value,
            "disabled" => $disabled,
            "options" => NULL,
            "id" => NULL,
            "is-public" => NULL
        ));
    }

    // Password
    function addPassword($name, $placeholder, $value, $disabled) {
        array_push($this->inputValues, array(
            "type" => "password",
            "name" => $name,
            "placeholder" => $placeholder,
            "label" => NULL,
            "checked" => NULL,
            "value" => $value,
            "disabled" => $disabled,
            "options" => NULL,
            "id" => NULL,
            "is-public" => NULL
        ));
    }

    function addPasswordWithLabel($name, $placeholder, $label, $value, $disabled) {
        array_push($this->inputValues, array(
            "type" => "password",
            "name" => $name,
            "placeholder" => $placeholder,
            "label" => $label,
            "checked" => NULL,
            "value" => $value,
            "disabled" => $disabled,
            "options" => NULL,
            "id" => NULL,
            "is-public" => NULL
        ));
    }

    // Dropdown
    function addDropdown($name, $options) {
        array_push($this->inputValues, array(
            "type" => "dropdown",
            "name" => $name,
            "placeholder" => NULL,
            "label" => NULL,
            "checked" => NULL,
            "value" => NULL,
            "disabled" => NULL,
            "options" => $options,
            "id" => NULL,
            "is-public" => NULL
        ));
    }

    function addDropdownWithLabel($name, $label, $options) {
        array_push($this->inputValues, array(
            "type" => "dropdown",
            "name" => $name,
            "placeholder" => NULL,
            "label" => $label,
            "checked" => NULL,
            "value" => NULL,
            "disabled" => NULL,
            "options" => $options,
            "id" => NULL,
            "is-public" => NULL
        ));
    }

    // Radiobutton
    function addRadioButton($name, $placeholder, $label, $checked, $disabled) {
        array_push($this->inputValues, array(
            "type" => "radio",
            "name" => $name,
            "placeholder" => $placeholder,
            "label" => $label,
            "checked" => $checked,
            "value" => NULL,
            "disabled" => $disabled,
            "options" => NULL,
            "id" => NULL,
            "is-public" => NULL
        ));
    }

    // Checkbox
    function addCheckbox($label, $disabled) {
        array_push($this->inputValues, array(
            "type" => "checkbox",
            "name" => NULL,
            "placeholder" => NULL,
            "label" => $label,
            "checked" => NULL,
            "value" => NULL,
            "disabled" => $disabled,
            "options" => NULL,
            "id" => NULL,
            "is-public" => NULL
        ));
    }

    // Switch (custom, see https://wikiki.github.io/form/switch/)
    // The id is related to how the switch should look like. For instance, you can pass 'switchThinColorInfo'
    // in order to display a thin switch with info color. See documentation for details.
    function addSwitch($name, $label, $checked, $id) {
        array_push($this->inputValues, array(
            "type" => "switch",
            "name" => $name,
            "placeholder" => NULL,
            "label" => $label,
            "checked" => $checked,
            "value" => NULL,
            "disabled" => NULL,
            "options" => NULL,
            "id" => $id,
            "is-public" => NULL
        ));
    }

    // TinyMCE textarea
    function addTinyMCE($name, $placeholder, $label, $isPublic) {
        array_push($this->inputValues, array(
            "type" => "tinymce",
            "name" => $name,
            "placeholder" => $placeholder,
            "label" => $label,
            "checked" => NULL,
            "value" => NULL,
            "disabled" => NULL,
            "options" => NULL,
            "id" => NULL,
            "is-public" => $isPublic
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
            "type" => "image",
            "name" => $name,
            "placeholder" => NULL,
            "label" => $label,
            "checked" => NULL,
            "value" => NULL,
            "disabled" => NULL,
            "options" => NULL,
            "id" => NULL,
            "is-public" => NULL
        ));
        if(!$this->upload)
            $this->upload = true;
    }

    // Add reCAPTCHA verification
    function addRecaptcha() {
        $this->recaptcha = true;
    }

    // Is horizontal
    function setIsHorizontal($bool) {
        $this->isHorizontal = $bool;
    }

    // Custom hive key
    function setCustomHiveKey($hiveKey) {
        $this->customHiveKey = $hiveKey;
    }

    // Size (e.g. 'is-large', 'is-small')
    function setSize($size) {
        $this->size = $size;
    }

    function build() {
        $this->buildFormHeader();
        $this->buildCsrfToken();
        $this->buildHorizontalHeader();
        $this->buildInputValues();
        $this->buildRecaptcha();
        $this->buildSubmitButton();
        $this->buildHorizontalFooter();
        $this->buildFormFooter();
        $this->addHiveKey();
    }

    private function buildFormHeader() {
        $html = '<form';
        if(!is_null($this->method)) {
            $html .= ' method="' . $this->method . '"';
        }
        if(!is_null($this->action)) {
            $html .= ' action="' . $this->action . '"';
        }
        if($this->upload) {
            $html .= ' enctype="multipart/form-data"';
        }
        $html .= '>';
        $this->html = $html;
    }

    private function buildInputValues() {
        $html = '';
        foreach($this->inputValues as $inputValue) {
            switch($inputValue['type']) {
                case 'text':
                case 'email':
                case 'password':
                    $html .= $this->buildDefaultInput($inputValue);
                    continue;
                case 'radio':
                    $html .= $this->buildRadioButton($inputValue);
                    continue;
                case 'checkbox':
                    $html .= $this->buildCheckbox($inputValue);
                    continue;
                case 'dropdown':
                    $html .= $this->buildDropdown($inputValue);
                    continue;
                case 'image':
                    $html .= $this->buildImage($inputValue);
                    continue;
                case 'tinymce':
                    $html .= $this->buildTinyMCE($inputValue);
                    continue;
                case 'switch':
                    $html .= $this->buildSwitch($inputValue);
                    continue;
                default:
                    continue;
            }
        }
        $this->html .= $html;
    }

    private function buildDropdown($inputValue) {
        $html = '<div class="field">';
        if(!empty($inputValue['label'])) {
            $html .= '<label class="label">' . $inputValue['label'] . '</label>';
        }
        $html .= '<div class="control">';
        $html .= '<div class="select">';
        $html .= '<select name="' . $inputValue['name'] . '">';
        foreach($inputValue['options'] as $option) {
            $html .= '<option>' . $option . '</option>';
        }
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    private function buildDefaultInput($inputValue) {
        $html = '<div class="field">';
        if(!empty($inputValue['label'])) {
            $html .= '<label class="label">' . $inputValue['label'] . '</label>';
        }
        $html .= '<div class="control">';
        $html .= '<input class="input ' . $this->getSize() . '" name="' . $inputValue['name'] . '" type="' . $inputValue['type'] . '" placeholder="' . $inputValue['placeholder']
            . '" autofocus="" value="' . $this->getValue($inputValue) . '" ' . $this->getDisabled($inputValue) . '>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    private function buildRadioButton($inputValue) {
        $html = '<div class="control">';
        $html .= '<label class="radio">';
        $html .= '<input type="radio" name="' . $inputValue['name'] . '"';
        $html .= empty($inputValue['checked']) ? ' />' : ' checked ' . $this->getDisabled($inputValue) . '>';
        $html .= ' ' . $inputValue['label'];
        $html .= '</label>';
        $html .= '</div>';
        return $html;
    }

    private function buildCheckbox($inputValue) {
        $html = '<div class="field">';
        $html .= '<div class="control">';
        $html .= '<label class="checkbox">';
        $html .= '<input type="checkbox" ' . $this->getDisabled($inputValue) . '>';
        $html .= ' ' . $inputValue['label'];
        $html .= '</label>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    private function buildImage($inputValue) {
        $html = '<input type="hidden" name="MAX_FILE_SIZE" value="' . Base::instance()->get('form.image_size_max') . '"/>';
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

    private function buildSwitch($inputValue) {
        $html = '<div class="field">';
        $checked = $inputValue['checked'] ? 'checked="checked"' : '';
        $id = $inputValue['id'];
        $html .= '<input id="' . $id . '" type="checkbox" name="' . $inputValue['name'] . '" class="switch" ' . $checked . '">';
        $html .= '<label for="' . $id . '">' . $inputValue['label'] . '</label>';
        $html .= '</div>';
        return $html;
    }

    /**
     * Builds the TinyMCE component. If the component is public,
     * another css class will be added and, hence, another
     * TinyMCE configuration is required.
     * @param $inputValue
     * @return string
     */
    private function buildTinyMCE($inputValue) {
        $html = '<div class="field">';
        if(!empty($inputValue['label'])) {
            $html .= '<label class="label">' . $inputValue['label'] . '</label>';
        }
        $cssClass = $inputValue['is-public'] ? 'editor' : 'syseditor';
        $html .= '<textarea class="' . $cssClass . '" name="' . $inputValue['name'] . '">' . $inputValue['placeholder'] . '</textarea>';
        return $html;
    }

    private function buildSubmitButton() {
        if(is_null($this->submit)) {
            $submit = Base::instance()->get('form.submit_label_default');
        } else {
            $submit = $this->submit;
        }
        $this->html .= '<br /><button type="submit" value="upload" class="button ' . $this->additionalSubmitStyling . ' ' . $this->getSize() . '">' . $submit . '</button>';
    }

    private function buildRecaptcha() {
        if($this->recaptcha) {
            $this->html .= '<br />';
            $this->html .= '<div class="g-recaptcha" data-sitekey="' . Base::instance()->get('RECAPTCHA_SITE_KEY') . '"></div>';
        }
    }

    private function buildFormFooter() {
        $this->html .= '</form>';
    }

    private function buildCsrfToken() {
        $f3 = Base::instance();
        if($f3->exists('form.csrf_protection')) {
            if($f3->get('form.csrf_protection')) {
                $f3->copy('CSRF','SESSION.csrf');
                $this->html .= '<input type="hidden" name="token" value="' . $f3->get('SESSION.csrf') . '" />';
            }
        }
    }

    private function buildHorizontalHeader() {
        if($this->isHorizontal) {
            $this->html .= '<div class="field is-horizontal">';
            $this->html .= '<div class="field-body">';
        }
    }

    private function buildHorizontalFooter() {
        if($this->isHorizontal) {
            $this->html .= '</div>';
            $this->html .= '</div>';
        }
    }

    private function addHiveKey() {
        $f3 = Base::instance();
        if(is_null($this->customHiveKey)) {
            $f3->set('FORM', $this->html);
        } else {
            $f3->set($this->customHiveKey, $this->html);
        }
    }

    private function getValue($inputValue) {
        $value = $inputValue[5];
        if(empty($value)) {
            return '';
        }
        return $value;
    }

    private function getDisabled($inputValue) {
        $isDisabled = $inputValue[6];
        if($isDisabled) {
            return 'disabled';
        }
        return '';
    }

    private function getSize() {
        $size = $this->size;
        if($size == null) {
            $size = $this->size = Base::instance()->get('form.submit_button_size');
        }
        return $size;
    }
}