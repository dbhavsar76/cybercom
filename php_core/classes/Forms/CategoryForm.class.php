<?php

namespace Forms;

use Model\Category;

class CategoryForm {
    public static $allowed_types = [IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_JPEG2000];

    public static function validateForm(&$validated, $form_values, &$errors, $mode='') {
        if (empty($form_values['title'])) {
            $validated = false;
            $errors['title'] = '* Title is required';
        }

        if (empty($form_values['content'])) {
            $validated = false;
            $errors['content'] = '* Content is required';
        }

        if (empty($form_values['url'])) {
            $validated = false;
            $errors['url'] = '* url is required';
        } else {
            $cat = new Category($form_values['id'], null, null, null, $form_values['url']);
            if ($cat->exists($mode)) {
                $validated = false;
                $errors['url'] = '* url is already registered';    
            }
        }

        if (empty($form_values['meta_title'])) {
            $validated = false;
            $errors['meta_title'] = '* Meta Title is required';
        }

        if (empty($form_values['image']) || empty($form_values['image']['name']) || !file_exists($form_values['image']['tmp_name'])) {
            $validated = false;
            $errors['image'] = '* Image upload is Required.';
        } else {
            $info = getimagesize($form_values['image']['tmp_name']);
            // check if file uploaded is an image
            if ($info === false) {
                $validated = false;
                $errors['image'] = '* Uploaded file is not an image or is a corrupt file.';
            } else if (array_search($info[2], self::$allowed_types) === false) {
                // check if image is of allowed type
                $validated = false;
                $errors['image'] = '* Image type is not PNG, JPG or JPEG.';
            } // can also add resolution check with $info[0] (width) and $info[1] (height)
            else if ($form_values['image']['size'] > 500000) {
                $validated = false;
                $errors['image'] = '* Image size exceeds 500KB.';
            }
        }


    }
}