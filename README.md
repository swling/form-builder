# Dynamic Bulma form builder for the Fatfree framework
Due to the lack of a proper form builder for the Fatfree framework, I created my own builder. Thanks to 
Bulma css framework compatibility, this piece of code is a modern and reliable choice for people who want to generate forms fast.

The form builder is provided as single class and 'as is'. However, if you observe the code, it should be not that difficult to extend the builder
with your own elements.

The form builder supports all default actions and, after some minor configuration, TinyMCE, image uploads, and ReCATPCHA.

# Get started
First, you need to install [Bulma][1] and [Bulma Extensions][2] properly. For this, read their documentation. Albeit you can install both assets manually, it is strongly advised to use NPM. However, how you implement
the stylesheets into your project and whether you want to use *vanilla css* or SASS, is completely up to you. For the sake of personal preferences :)

Next, install TinyMCE. This is optinally, but required if you want to use the TinyMCE option in the builder. See the [TinyMCE][5] documentation in order to install it. Moreover, if you want to use [ReCAPTCHA][6]v2 in this form, you have to install this as well. Please note that, in order to use recaptcha, you have to specify the global Fatfree hive key RECAPTCHA_SITE_KEY.

Subsequently, you have to set up the form configuration file. Make sure you load this file with Fatfree initially, so before serving your application
to visitors. See the [Fatfree documentation][3] for details. 

The minimal form configuration file in order to work with the dynamic form builder:
```
[form]

csrf_protection = TRUE
image_size_max = 2000000
submit_button_size = is-medium
submit_label_default = OK
```

- csrf_protection: used to add the hidden csrf input field to the form. Caution: the form builder does not provide any csrf implementation whatsoever. However,
you can implement it yourself. See https://fatfreeframework.com/3.6/session. You might want to add something like this to your beforeroute method:
```
/**
 * Handles any csrf attack attempt. Will log off directly if one
 * is trying to perform such an attack.
 */
private function verifyCsrfAttack() {
    if($this->f3->exists('form.csrf_protection')) {
        if($this->f3->get('form.csrf_protection') && $this->f3->VERB=='POST') {
            if($this->f3->get('POST.token') != $this->f3->get('SESSION.csrf')) {
                // Do something
            }
        }
    }
}
```
- image_size_max: the max file size in bytes. See http://php.net/manual/en/features.file-upload.post-method.php;
- submit_button_size: the default size for a submit button. This corresponds to the [Bulma size tag][4];
- submit_label_default: the default submit button label.

# How to use it
There are various form elements that this builder supports, namely:

- addText
- addTextWithLabel
- addEmail
- addEmailWithLabel
- addPassword
- addPasswordWithLabel
- addDropdown
- addDropdownWithLabel
- addRadioButton
- addCheckbox
- addSwitch
- addTinyMCE (you have to install TinyMCE yourself, see https://imgur.com/a/MBeOUl5)
- addSubmitButton
- addImageUpload
- addRecaptcha (you have to install ReCAPTCHA yourself)

Furthermore, you can specify more details:
- setIsHorizontal (whether the form is horizontal, so you can use it in a navbar, for instance. See https://imgur.com/a/t3Hmu9h)
- setCustomHiveKey (default the hive key of the form is FORM, but you can adjust this with this setter)
- setSize (adjust the size of the submit button. For example, 'is-small' or 'is-large', according to a Bulma tag)

# Examples
```
function register()
{
    $form = new Form();
    $form->addTextWithLabel('gebruikersnaam', 'Gebruikersnaam', 'Gebruikersnaam', NULL, false);
    $form->addTextWithLabel('voornaam', 'Voornaam', 'Voornaam', NULL, false);
    $form->addTextWithLabel('achternaam', 'Achternaam', 'Achternaam', NULL, false);
    $form->addEmailWithLabel('email', 'E-mailadres', 'E-mailadres', NULL, false);
    $form->addPasswordWithLabel('password', '***********', 'Wachtwoord', NULL, false);
    $form->addPasswordWithLabel('password-check', '***********', 'Wachtwoord (bevestigen)', NULL, false);
    $form->addAction('POST', $this->f3->get('BASE') . "/register/create");
    $form->addSubmitButton($this->f3->get('messages.general.system.signup'), 'is-info');
    $form->addRecaptcha();
    $form->build();
}
```

For displaying the form, add this to your view:
```
{{ @FORM | raw }}
```
If you are setting up a custom hive key, you have to provide that key instead.

Result: https://imgur.com/a/2NU6WTW

[1]: https://bulma.io
[2]: https://github.com/Wikiki/bulma-extensions
[3]: https://fatfreeframework.com/3.6/framework-variables#ConfigurationFiles
[4]: https://bulma.io/documentation/elements/tag/
[5]: https://www.tinymce.com
[6]: https://developers.google.com/recaptcha/docs/display
