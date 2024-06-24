<?php


//これで先ずは入力値を取得する → 完成
const SPLIT_LENGTH = 2;

function getInput(){

$arguments = (array_slice($_SERVER['argv'], 1));
    //[[1, 30], [5, 25], ....]
    return array_chunk($arguments, SPLIT_LENGTH);
}

function groupChannelViewingPeriods(array $inputs): array{
    //先ずは、データの入れ物を用意する
    //$channelViewingPeriodsは、空配列でこれに値を入れる配列を用意する
    //$inputsのそれぞれの値ごとに、全部処理していきたい → foreachでループを回す
    $channelViewingPeriods = [];

    foreach ($inputs as $input) {
        //先ずは、値を取り出す
        $chan = $input[0];
        $min = $input[1];
        //最終的に、視聴時間を配列で持ちたいので、ここで配列を定義しておく
        $mins = [$min];
        //ここで条件分岐が必要(チャンネルは複数回登場しうるので、それの複数回登場した用の条件分岐をしておく)
        /*どういう風に複数回登場しているかどうかを判断するかというと$channelViewingPeriodsのkey名である$chanが
        もうすでに存在していたら、1回登場しているということになる*/
        if (array_key_exists($chan, $channelViewingPeriods)) {
            $mins = array_merge($channelViewingPeriods[$chan], $mins);
        }
        //こうすることでチャンネルの番号がkeyで、値として視聴分数の配列が入っている配列になる
        $channelViewingPeriods[$chan] = $mins;
    }
        return $channelViewingPeriods;
}

function calculateTotalHour(array $channelViewingPeriods): float {
    //[ch => [min, min], ch =>  [min, min], ....]
    //[min, min] ← このvalueの値を全部、1つの視聴時間にまとめると後で簡単に計算ができる
    //先ずは、1つの配列($viewingTimes)にまとめる
    $viewingTimes = [];
    //$channelViewingPeriods1つ1つに処理したいので、foreachでループ処理する
    foreach ($channelViewingPeriods as $period) {
        //$channelViewingPeriodsでループを回すと、チャンネル名ごとに値が$periodという形で入ってくる
        //それで入ってきたら毎回$viewingTimesという空配列と毎回合体させたい
        //ループが終わると、$viewingTimesに全ての$period(値)が入った配列が出来上がる
        $viewingTimes = array_merge($viewingTimes, $period);
    }
        $totalMin = array_sum($viewingTimes);
        //最後に、min → hour に変換する
        return round($totalMin / 60, 1);
}

    function display(array $channelViewingPeriods): void{
        $totalHour = calculateTotalHour($channelViewingPeriods);
        echo $totalHour . PHP_EOL;
        foreach ($channelViewingPeriods as $chan => $mins) {
            echo $chan . ' ' . array_sum($mins) . ' ' . count($mins) . PHP_EOL;
        }
    }

$inputs = getInput();
$channelViewingPeriods = groupChannelViewingPeriods($inputs);
display($channelViewingPeriods);
