<?php

/*echo gettype(1) . PHP_EOL;
echo gettype(0) . PHP_EOL;
echo gettype(-1) . PHP_EOL; */

/*var_dump(0b10);
var_dump(010);
var_dump(0x10);*/



/*$number = 1;

if ($number === true ) {
    echo 'true' . PHP_EOL;
}elseif ($number === 1) {
    echo '1' . PHP_EOL;
}else {
    echo 'default' . PHP_EOL;
}*/

//タスクバラシ

//①配列を作り、その配列の全ての値を合計すればいい（税込み）
//②販売個数のMAX・MINを調べる


//①で、商品が税抜きなので税金(固定値)を考える
//商品*1.08 = 代金；  $goods * TAX = $price

const TAX = 1.08;

$goods = [
    100,
    120,
    150,
    250,
    80,
    120,
    100,
    180,
    50,
    300
];

function sum($number){
    $price = $number * TAX;
    return $price;
}

$price = array_map('sum', $goods);

print_r($price);
//ここまでで、配列の値が全て税込みになった


