<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetValues
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;

class NumToWord extends Component {
        /*
         * default Upload image function
         */

        public function convert_number_to_words($number, $currency = 'AED') {
                $hyphen = ' ';
                $conjunction = ' and ';
                $separator = ' ';
                $negative = 'negative ';
                $decimal = '  ';
                $dictionary = array(
                    0 => 'zero',
                    1 => 'One',
                    2 => 'Two',
                    3 => 'Three',
                    4 => 'Four',
                    5 => 'Five',
                    6 => 'Six',
                    7 => 'Seven',
                    8 => 'Eight',
                    9 => 'Nine',
                    10 => 'Ten',
                    11 => 'Eleven',
                    12 => 'Twelve',
                    13 => 'Thirteen',
                    14 => 'Fourteen',
                    15 => 'Fifteen',
                    16 => 'Sixteen',
                    17 => 'Seventeen',
                    18 => 'Eighteen',
                    19 => 'Nineteen',
                    20 => 'Twenty',
                    30 => 'Thirty',
                    40 => 'Fourty',
                    50 => 'Fifty',
                    60 => 'Sixty',
                    70 => 'Seventy',
                    80 => 'Eighty',
                    90 => 'Ninety',
                    100 => 'Hundred',
                    1000 => 'Thousand',
                    //Instead of the following values I would like to have Indian counting system values
                    /*
                      1000000             => 'million',
                      1000000000          => 'billion',
                      1000000000000       => 'trillion',
                      1000000000000000    => 'quadrillion',
                      1000000000000000000 => 'quintillion'
                     */
                    100000 => 'lakh',
                    10000000 => 'crore',
                    1000000000 => 'hundred crore',
                    100000000000 => 'ten thousand crore'
                );

                if (!is_numeric($number)) {
                        return false;
                }

                if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
                        // overflow
                        trigger_error(
                                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
                        );
                        return false;
                }

                if ($number < 0) {
                        return $negative . $this->convert_number_to_words(abs($number));
                }

                $string = $fraction = null;

                if (strpos($number, '.') !== false) {
                        list($number, $fraction) = explode('.', $number);
                }

                switch (true) {
                        case $number < 21:
                                $string = $dictionary[$number];
                                break;
                        case $number < 100:
                                $tens = ((int) ($number / 10)) * 10;
                                $units = $number % 10;
                                $string = $dictionary[$tens];
                                if ($units) {
                                        $string .= $hyphen . $dictionary[$units];
                                }
                                break;
                        case $number < 1000:
                                $hundreds = $number / 100;
                                $remainder = $number % 100;
                                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                                if ($remainder) {
                                        $string .= $conjunction . $this->convert_number_to_words($remainder);
                                }
                                break;
                        default:
                                $baseUnit = 10 * pow(100, floor(log($number / 10, 100))); // Thanks to rici and Patashu
                                $numBaseUnits = (int) ($number / $baseUnit);
                                $remainder = $number % $baseUnit;
                                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                                if ($remainder) {
                                        $string .= $remainder < 100 ? $conjunction : $separator;
                                        $string .= $this->convert_number_to_words($remainder);
                                }
                                break;
                }

                if (null !== $fraction && is_numeric($fraction)) {
                        $string .= $decimal;
                        $words = array();
                        foreach (str_split((string) $fraction) as $number) {
                                $words[] = $dictionary[$number];
                        }
                        $string .= $this->convert_number_to_words($fraction);
                }

                return $string;
        }

        public function NumberFormat($grandtotal) {
                $s = explode('.', $grandtotal);
                $amount = $s[0];
                if (isset($s[1])) {
                        $decimal = $s[1];
                } else {
                        $decimal = '00';
                } if ($amount != '') {
                        $total = $english_format_number = number_format($amount);
                        if ($decimal != 0) {
                                $grandtotal = $total . '.' . $decimal;
                        } else {
                                $grandtotal = $total . '.00';
                        } return $grandtotal;
                } else {
                        return;
                }
        }

}
