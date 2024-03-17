<?php

namespace Utils;

class BigNumber
{
    private string|int|float $value;

    public function __construct($value) {
        if (!is_string($value) && !is_numeric($value)) {
            throw new \InvalidArgumentException("Value must be a number or string");
        }
        $this->value = $value;
    }

    public function getValue(){
        return $this->value;
    }

    // ... (其他現有方法)

    public function divide(BigNumber $other) {
        if (gmp_cmp($other->value, "0") == 0) {
            throw new \DivisionByZeroError("Cannot divide by zero");
        }
        $s = gmp_div($this->value, $other->value);
        return new BigNumber($s);
    }

    public function greaterThan(BigNumber $other) {
        return gmp_cmp($this->value, $other->value) > 0;
    }

    public function lessThan(BigNumber $other) {
        return gmp_cmp($this->value, $other->value) < 0;
    }

    public function add(BigNumber $other) {

        $sum = gmp_add($this->value, $other->value);

        return new BigNumber($sum);
    }

    public function subtract(BigNumber $other) {

        $difference = gmp_sub($this->value, $other->value);

        return new BigNumber($difference);
    }

    public function multiply(BigNumber $other) {

        $product = gmp_mul($this->value, $other->value);

        return new BigNumber($product);
    }

    public function toString() {
        return gmp_strval($this->value);
    }

    // 進階計算技巧

    public function log(BigNumber $other) {
        $log2 = log10($this->value) / log10($other->value);
        return new BigNumber($log2);
    }

    public function abs() {
        return gmp_abs($this->value);
    }

    public function pow($exponent) {
        $quotient = gmp_pow($this->value, $exponent);
        return new BigNumber($quotient);
    }

    public function mod($modulus) {
        $quotient = gmp_mod($this->value, $modulus);
        return new BigNumber($quotient);
    }

    public function sqrt() {
        $quotient = gmp_sqrt($this->value);
        return new BigNumber($quotient);
    }

    public function cbrt() {
        $quotient = gmp_($this->value);
        return new BigNumber($quotient);
    }

}
