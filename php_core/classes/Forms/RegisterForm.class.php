<?php

namespace Forms;

use Model\User;

class RegisterForm {
    public static function validateForm(&$validated, $form_values, &$errors) {
        if (empty($form_values['prefix'])) {
            $validated = false;
            $errors['prefix'] = '* Prefix is required';
        }

        if (empty($form_values['first_name'])) {
            $validated = false;
            $errors['first_name'] = '* First name is required';
        }

        if (empty($form_values['last_name'])) {
            $validated = false;
            $errors['last_name'] = '* Last name is required';
        }

        if (empty($form_values['email'])) {
            $validated = false;
            $errors['email'] = '* Email is required';
        }  else if (!filter_var($form_values['email'], FILTER_VALIDATE_EMAIL)) {
            $validated = false;
            $errors['email'] = '* Invalid email address';
        } else {
            $user = new User(null, null, null, null, $form_values['email']);
            if ($user->exists()) {
                $validate = false;
                $errors['email'] = '* Email address already registered';
            }
        }

        if (empty($form_values['mobile'])) {
            $validated = false;
            $errors['mobile'] = '* Mobile number is required';
        }  else if (!preg_match('/^[0-9]{10}$/', $form_values['mobile'])) {
            $validated = false;
            $errors['mobile'] = '* Invalid Mobile number. Enter 10 digit mobile number.';
        }

        if (empty($form_values['password'])) {
            $validated = false;
            $errors['password'] = '* Password is required';
        } else if (empty($form_values['password2']) || $form_values['password2'] != $form_values['password']) {
            $validated = false;
            $errors['passwor2'] = '* Password does not match';
        }

        if (empty($form_values['information'])) {
            $validated = false;
            $errors['information'] = '* Some information is required';
        }

        if (empty($form_values['tnc'])) {
            $validated = false;
            $errors['tnc'] = '* You must agree to TnC';
        }
    }
}