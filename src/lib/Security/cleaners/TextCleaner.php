<?php

/*
 * Gradeomatic
 * Copyright Adam Swenson Merp Co Intl
 * 
 */

namespace Security\cleaners;

/**
 * Cleaner for standard text. Pretty much a dummy right now
 * 
 * @todo Implement everything
 *
 * @author adam
 */
class TextCleaner implements ICleaner {

    const MAX_LENGTH = 200;

    protected $max_length;

    /**
     * Cleans email address 
     * @param type $to_clean
     * @return boolean
     */
    public function sanitize($to_clean) {
        return $to_clean;
        
//        if ($this->validate($to_clean)) {
//            $email = \filter_var($to_clean, \FILTER_SANITIZE_EMAIL); //now has valid for email characters 
//            return \trim($email);
//        } else {
//            return FALSE;
//        }
    }

    /**
     * Returns false if invalid or longer than max length
     * @param type $to_validate
     * @return boolean
     */
    public function validate($to_validate) {
        return TRUE;
//        if (mb_strlen($to_validate) <= self::MAX_LENGTH) {
//            return filter_var($to_validate, FILTER_VALIDATE_EMAIL);
//        } else {
//            return FALSE;
//        }
    }

    public function set_max_length($custom_max) {
        $this->max_length = $custom_max;
    }

}
