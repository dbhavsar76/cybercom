<?php

namespace Forms;

class LoginForm {
    public static function validateForm(&$validated, $form_values, &$errors) {
        if (empty($form_values['email'])) {
            $validated = false;
            $errors['email'] = '* Email is required';
        }  else if (!filter_var($form_values['email'], FILTER_VALIDATE_EMAIL)) {
            $validated = false;
            $errors['email'] = '* Invalid email address';
        }

        if (empty($form_values['password'])) {
            $validated = false;
            $errors['password'] = '* Password is required';
        }
    }
}