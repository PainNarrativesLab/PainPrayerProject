<?php

/*
 * Gradeomatic
 * Copyright Adam Swenson Merp Co Intl
 *
 */

namespace Security\nonces;

/**
 * Description of NonceValidator
 *
 * @author adam
 */
class NonceValidator
{
    const MAX_PAGE_NAME_LENGTH = 50;
    const TIME_LIMIT = 3600; //one hour

    /** @var $logger \Security\logging\ISecurityLoggers */
    public $logger;

    /** @var $session_handler \Security\nonces\INonceSessionHandler */
    protected $session_handler;

    public function set_logger(\Security\logging\ISecurityLoggers $logger)
    {
        $this->logger = $logger;
    }

    public function set_session_handler(\Security\nonces\INonceSessionHandler $handler)
    {
        $this->session_handler = $handler;
    }

    /**
     * This performs the actual checking on the cleaned inputs
     * @param type $page_name
     * @param Nonce|type $nonce
     * @return bool
     */
    protected function check_nonce($page_name, \Security\nonces\Nonce $nonce)
    {
        $stored_nonce = $this->session_handler->get_nonce($page_name);
        //verify token matches
        if ($stored_nonce->token === $nonce->token) {
            if ((time() - $stored_nonce->time) <= self::TIME_LIMIT) {
                return TRUE;
            }
        }
    }

    /**
     * This wraps the checkNonce function to do error handling and deal with the result.
     * this is what gets publically called;
     * @param $page_name
     * @param $token
     * @return bool
     * @throws \Exception
     * @internal param string $nonce
     */
    public function validate($page_name, $token)
    {
        if ((ctype_alnum($page_name)) && (mb_strlen($page_name) <= self::MAX_PAGE_NAME_LENGTH)) {
            $nonce = new Nonce();
            $nonce->token = $token;
            if (self::check_nonce($page_name, $nonce)) {
                return TRUE;
            } else {
                //invalid nonce
                $this->logger->securityEvent("Nonce failed validation");

                //possibly log out current session for safety
                //Redirect the user to private page and exit script to stop processing
                //redirectIt(SECURELOGIN);
                //important to exit script and to stop any further processing
                //exit();
            }
        } else {
            throw new \Exception("Invalid page name");
        }
    }

}
