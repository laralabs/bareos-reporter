<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Helper Class
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App;

class Helper
{
    /**
     * secondsToTime function.
     *
     * Credit to: http://stackoverflow.com/a/19680778
     *
     * @param $seconds
     * @return string
     */
    public static function secondsToTime($seconds) {
        if(!empty($seconds))
        {
            $dtF = new \DateTime("@0");
            $dtT = new \DateTime("@$seconds");
            return $dtF->diff($dtT)->format('%a Days');
        }
        else
        {
            return '';
        }
    }

    /**
     * Transform JSON Encoded array into a readable string
     *
     * @param $clients
     * @return string
     */
    public static function returnReadableClients($clients)
    {
        $clients = json_decode($clients);
        $string = '';

        foreach($clients as $client)
        {
            $string = $string.$client->name.', ';
        }

        return $string;
    }

    /**
     * Check domain MX Records, return boolean.
     *
     * @param $email
     * @return bool
     */
    public static function mxRecordValidation($email)
    {
        $domain = substr(strrchr($email, '@'), 1);
        $mxRecords = [];

        if($domain){
            $mxArray = getmxrr($domain, $mxRecords);
        }else{
            return false;
        }

        return $mxArray;
    }
}
