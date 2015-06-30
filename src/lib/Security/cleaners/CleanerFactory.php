<?php

/*
 * Gradeomatic
 * Copyright Adam Swenson Merp Co Intl
 * 
 */

namespace Security\cleaners;

/**
 * This will perform a validation or sanitization as needed
 *
 * @author adam
 */
class CleanerFactory implements ICleanerFactory {

    const INTEGER = 'integer';
    const FLOAT = 'float';
    const STRING = 'string';
    const TEXT = 'text';
    const EMAIL = 'email';

    public function validate($to_validate, $type) {
        $cleaner = $this->make($type);
        if ($cleaner) {
            return $cleaner->validate($to_validate);
        } else {
            return FALSE;
        }
    }

    public function sanitize($to_clean, $type) {
        $cleaner = $this->make($type);
        if ($cleaner) {
            return $cleaner->sanitize($to_clean);
        } else {
            return FALSE;
        }
    }

    /**
     * This chooses the right ICleaner and instantiates
     * @param type $type
     * @return bool|EmailCleaner|FloatCleaner|IntegerCleaner|TextCleaner
     */
    public function make($type) {
        switch ($type) {
            case self::INTEGER:
                $cleaner = new \Security\cleaners\IntegerCleaner();
                break;
            case self::FLOAT:
                $cleaner = new \Security\cleaners\FloatCleaner();
                break;
            case self::STRING:
                $cleaner = new \Security\cleaners\TextCleaner();
                break;
            case self::TEXT:
                $cleaner = new \Security\cleaners\TextCleaner();
                break;
            case self::EMAIL:
                $cleaner = new \Security\cleaners\EmailCleaner();
                break;
            default:
                return FALSE;
        }
        return $cleaner;
    }

}
