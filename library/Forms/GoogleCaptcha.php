<?php/** @see Zend_Service_ReCaptcha_Response */class Google_Service_ReCaptcha extends Zend_Service_ReCaptcha{    public function getHtml($name = null) {                return '<div class="g-recaptcha" data-sitekey="'.$this->_publicKey.'"></div>';          }}