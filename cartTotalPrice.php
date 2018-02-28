<?php

// Get skus from user 
// Ex: php cartTotalPrice.php ABCDABAA
$inputSkus = str_split($argv[1], 1);

// Counts all the values of an array
$countSkuArray = array_count_values($inputSkus);
#print_r($counts);

// Set each product price and bundel pro
$products = [
    'A' => [
        '1' => 2.00,
        '4' => 7.00
    ],
    'B' => [
        '1' => 12.00
    ],
    'C' => [
        '1' => 1.25,
        '6' => 6.00
    ],
    'D' => [
        '1' => 0.15
    ]
];

// Final total price
$total = 0;

foreach ($countSkuArray as $cartSku => $price) {
    
    
    if (isset($products[$cartSku]) && count($products[$cartSku]) > 1) {
        
        $groupUnit = max(array_keys($products[$cartSku]));
        $subtotal = intval($price / $groupUnit) * $products[$cartSku][$groupUnit] + fmod($price, $groupUnit) * $products[$cartSku]['1'];
        
        $total += $subtotal;
        
    } elseif (isset($products[$cartSku])) {
        
        $subtotal = $price * $products[$cartSku]['1'];
        $total += $subtotal;
    }

    echo "\nSKU = " . $cartSku . " QTY = ".count($products[$cartSku]) . " Subtotal = $" . number_format($subtotal, 2);
}

echo "\nFinal Total: $" . number_format($total, 2)."\n";

?>