<?php

namespace Utils;

use Exception;
use LZCompressor\LZString;

class Utilsv2
{
    public static function is_BigNumber($va): bool
    {
        // 使用 bcmath 函數庫
        if (bccomp($va, 2147483647) > 0) {
            return true;
        }
        return false;
    }


    public static function generateRandomString($length): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $result = '';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $result .= $characters[rand(0, $charactersLength - 1)];
        }
        return $result;
    }

    public static function encodeContext($data): array
    {
        $hash = "";
        $encodeBase64 = LZString::compressToBase64(base64_encode(urlencode(htmlspecialchars($data))));
        $source = $encodeBase64;
        $length = strlen($encodeBase64);
        $randomNumbers = self::generateRandomNumbers(0, $length - 1, intval(($length - 1) / 6));
        foreach ($randomNumbers as $k => $value) {
            list($str, $index, $shiftIndex) = self::string_move_shift($encodeBase64, $k, $value);
            $encodeBase64 = $str;
            $hash .= $index . "&" . $shiftIndex . "$";
        }
        $compress = LZString::compressToBase64($encodeBase64 . "." . $hash);
        return [
            'source' => $source,
            'hash' => $hash,
            'encode' => $encodeBase64,
            'compress' => $compress
        ];
    }

    public static function decodeContext($compress): string
    {
        $raw_data = LZString::decompressFromBase64($compress);
        $strings = explode('.', $raw_data);
        $data = $strings[0];
        $hash = $strings[1];
        $hashChunks = explode("$", $hash);
        $hashChunk2 = [];
        foreach ($hashChunks as $hashChunkElement) {
            if($hashChunkElement !== ""){
                $tt = explode("&", $hashChunkElement);
                $hashChunk2[intval($tt[0])] = intval($tt[1]);
            }
        }
        for ($i = count($hashChunk2) - 1; $i > -1; $i--) {
            $str = self::string_move_shift($data, $i, $hashChunk2[$i]);
            $data = $str[0];
        }
        return htmlspecialchars_decode(urldecode(base64_decode(LZString::decompressFromBase64($data))));
    }

    /**
     * @throws Exception
     */
    public static function generateRandomNumbers($rangeStart, $rangeEnd, $numNumbers) {
        if ($numNumbers > ($rangeEnd - $rangeStart + 1)) {
            throw new Exception("Number of requested numbers exceeds range");
        }
        $randomNumbers = [];
        $availableNumbers = range($rangeStart, $rangeEnd);
        for ($i = 0; $i < $numNumbers; $i++) {
            $randomIndex = rand(0, count($availableNumbers) - 1);
            $randomNumber = $availableNumbers[$randomIndex];
            $randomNumbers[] = $randomNumber;
            array_splice($availableNumbers, $randomIndex, 1);
        }
        return $randomNumbers;
    }

    /**
     * @throws Exception
     */
    public static function string_move_shift($str, $index, $shift_index) {
        if ($index < 0 || $index >= strlen($str) || $shift_index < 0 || $shift_index >= strlen($str)) {
            throw new Exception("Invalid indices");
        }
        $chars = str_split($str);
        $temp = $chars[$index];
        $chars[$index] = $chars[$shift_index];
        $chars[$shift_index] = $temp;
        $newStr = implode("", $chars);
        return [$newStr, $index, $shift_index];
    }
}
