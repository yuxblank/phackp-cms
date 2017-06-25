<?php

/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 25/06/2017
 * Time: 21:09
 */
namespace cms\library;
class StringUtils
{

    public function toAscii($str, $replace = array("'"), $delimiter = '-')
    {

        if (!empty($replace)) {

            $str = str_replace((array)$replace, ' ', $str);

        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);

        $clean = preg_replace("/[^a-zA-Z0-9\\/_|+ -]/", '', $clean);

        $ts = array("/[À-Å]/", "/Æ/", "/Ç/", "/[È-Ë]/", "/[Ì-Ï]/", "/Ð/", "/Ñ/", "/[Ò-ÖØ]/", "/×/", "/[Ù-Ü]/", "/[Ý-ß]/", "/[à-å]/", "/æ/", "/ç/", "/[è-ë]/", "/[ì-ï]/", "/ð/", "/ñ/", "/[ò-öø]/", "/÷/", "/[ù-ü]/", "/[ý-ÿ]/");

        $tn = array("A", "AE", "C", "E", "I", "D", "N", "O", "X", "U", "Y", "a", "ae", "c", "e", "i", "d", "n", "o", "x", "u", "y");

        $clean = preg_replace($ts, $tn, $clean);

        $clean = strtolower(trim($clean, '-'));

        $clean = preg_replace("/[\\/_|+ -]+/", $delimiter, $clean);

        if (substr($clean, strlen($clean) - 1, 1) === "-") {

            $clean = rtrim($clean, '-');

        }


        return $clean;

    }
}