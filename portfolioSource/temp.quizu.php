<?php

/*  タスクバラシ
テレビを見るたびにチャンネルごとの視聴分数をメモしておき、一日の
終わりテレビの合計視聴時間と、チャンネルごとの視聴回数と視聴回数を出力してください。*/

/* 入力   入力例　php quit.php　1 30 5 25 2 30 1 15

テレビのチャンネル視聴分数 テレビのチャンネル視聴分数 ...

ただし、同じチャンネルを複数回見たときは、それぞれ分けて記録することです。*/

/*  出力　　出力例　
1.7
1 45 2
2 30 1
5 25 1

テレビの合計視聴時間
テレビのチャンネル視聴分数,  視聴回数
テレビのチャンネル視聴分数,  視聴回数  */

//定数をどこで使っている？
const SPLIT_LENGTH = 2;

function getInput(){
    //array_slice? 忘れているので復習
    //$_SERVER? 忘れているので復習 →OK
    //array_chunk? 忘れているので復習
    $arguments = (array_slice($_SERVER['argv'], 1));
    return array_chunk($arguments, SPLIT_LENGTH);
}

function groupChannelViewingPeriods(array $inputs): array{
    $channelViewingPeriods = [];
    //$channelViewingPeriodsは、空配列でこれに値を入れる配列を用意する
    //これに値を入れる配列とは？

    foreach ($inputs as $input) {
        $chan = $input[0];
        $min = $input[1];

        $mins = [$min];
        //$chanは、key名？
        //$mins
        if (array_key_exists($chan, $channelViewingPeriods)){
            $mins = array_merge($channelViewingPeriods[$chan],$mins);
        }
            $channelViewingPeriods[$chan] = $mins;

    }
        return $channelViewingPeriods;
}

function calculateTotalHour(array $channelViewingPeriods): float{
    $viewingTimes = [];
    foreach ($channelViewingPeriods as $period) {

        $viewingTimes = array_merge($viewingTimes, $period);
    }
        $totalMin = array_sum($viewingTimes);
        return round($totalMin / 60, 1);
}

function display(array $channelViewingPeriods): void{
    $totalHour = calculateTotalHour($channelViewingPeriods);
    echo $totalHour . PHP_EOL;
    foreach ($channelViewingPeriods as $chan => $mins) {
        echo $chan . '' . array_sum($mins) . '' . count($mins) . PHP_EOL;
    }
}

$input = getInput();
$channelViewingPeriods = groupChannelViewingPeriods($inputs);
display($channelViewingPeriods);
