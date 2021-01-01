<?php
namespace app\core;
/**
* Class Session
* 
* @author daMask
* @package app\core
*/

class Session {
    protected const FLASH_KEY = 'flash_messages';
    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage){ //&$ makes it by reference
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
    public function setFlash($key, $message){
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key){
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }
    public function __destruct(){
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage){ //&$ makes it by reference
           if($flashMessage['remove']){
               unset($flashMessages[$key]);
           }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
    
 }