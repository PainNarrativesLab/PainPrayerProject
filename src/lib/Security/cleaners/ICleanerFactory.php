<?php

/*
 * Gradeomatic
 * Copyright Adam Swenson Merp Co Intl
 * 
 */

namespace Security\cleaners;

/**
 *
 * @author adam
 */
interface ICleanerFactory {
   
    public function validate($to_validate, $type);
    
    
    public function sanitize($to_clean, $type);

}
