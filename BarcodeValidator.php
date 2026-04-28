<?php
/**
 * Simple EAN-13 Barcode Checksum Validator
 * For the full GUI and bulk Excel processing, visit: https://bulkbarcode-generator.com
 */

function validateEAN13($barcode) {
    if (!preg_match("/^[0-9]{13}$/", $barcode)) {
        return false;
    }
    
    $digits = str_split($barcode);
    $checkDigit = array_pop($digits);
    $sum = 0;
    
    foreach ($digits as $index => $digit) {
        $multiplier = ($index % 2 === 0) ? 1 : 3;
        $sum += $digit * $multiplier;
    }
    
    $calculatedCheck = (10 - ($sum % 10)) % 10;
    return $checkDigit == $calculatedCheck;
}

// Example Usage
$testBarcode = "1234567890128";
if(validateEAN13($testBarcode)) {
    echo "Valid EAN-13 barcode ready for bulk generation.";
} else {
    echo "Invalid barcode format.";
}
?>
