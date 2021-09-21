<?php

if (!function_exists('phone_make')) {
    /**
     * phone_make
     * Generate phone number in format: 658xxxxxxxxx
     *
     * @param  string $phone
     * @param  string $code
     * @return string
     */
    function phone_make(string $phone, string $code = '65') : string
    {
        $replace = [' ', ',', '-', '.', '(', ')', '+'];
        $phone = str_replace($replace, '', $phone);

        if( !preg_match('/[^0-9]/', trim($phone)) ) {
            if(substr(trim ($phone), 0, 2) == $code) {
                if(substr(trim ($phone), 0, 3) == $code.'0') {
                    $phone =  $code.substr(trim($phone), 3);
                }
                $phone = trim($phone);
            }else if ( substr(trim ($phone), 0, 2) == '08') {
                $phone =  $code.substr(trim($phone), 1);
            }else{
                $phone =  $code.'8'.substr(trim($phone), 2);
            }
        }
        return $phone;
    }
}

if (!function_exists('phone_validate')) {
    /**
     * phone_validate
     * Verify phone number value, is it already corect or not, if not it will generate based on format
     *
     * @param  string $phone
     * @param  string $code
     * @return string
     */
    function phone_validate(string $phone, string $code = '65') : string
    {
        if( !preg_match('/[^0-9]/', trim($phone)) ) {
            if(substr(trim ($phone), 0, 2) == $code) {
                $result = true;
            }else if ( substr(trim ($phone), 0, 2) == '08') {
                $result = false;
            }else{
                $result = false;
            }
        }else{
            $result = false;
        }
        if($result) {
            return $phone;
        }else{
            return phone_make($phone);
        }
    }
}
