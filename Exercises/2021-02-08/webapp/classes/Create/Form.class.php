<?php

namespace Create;

use Model\Contact;

class Form {
    public static function validateForm(&$validated, $form_values, &$errors) {
        if (empty($form_values['name'])) {
            $validated = false;
            $errors['name'] = '* Name is required';
        }
    
        if (empty($form_values['email'])) {
            $validated = false;
            $errors['email'] = '* Email is required';
        } else if (!filter_var($form_values['email'], FILTER_VALIDATE_EMAIL)) {
            $validated = false;
            $errors['email'] = '* Invalid email address';
        } else {
            $contact = new Contact(null, null, $form_values['email']);
            if ($contact->exists()) {
                $validated = false;
                $errors['email'] = '* Email address already exists';    
            }
        }
    
        if (empty($form_values['phone'])) {
            $validated = false;
            $errors['phone'] = '* Phone number is required';
        } else if (!preg_match('/^[6-9]\d{9}$/', $form_values['phone'])) {
            $validated = false;
            $errors['phone'] = '* Invalid phone number entered';
        }
    
        if (empty($form_values['title'])) {
            $validated = false;
            $errors['title'] = '* Title is required';
        }    
    }
}