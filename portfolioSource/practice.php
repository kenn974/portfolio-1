<?php

/*  タスクバラシ
    売上の合計
    販売個数の最も多い商品番号
    販売個数の最も少ない商品番号を求めたい/*

// input: 1 10 2 3 5 1 7 5 10 1

/*output : 2464
1
5 10 */

//データ構造を考えると、[[1,10], [2,3]...]

const FIXED_NUMBER = 2;


function getInput()
{
    $arguments = array_slice($_SERVER['argv'], 1);
    return array_chunk($arguments, FIXED_NUMBER);

}

//





$input = getInput();
var_dump($input);
