<?php

$myfile = fopen("test.txt", "w+");
$answer = fopen("answer.txt", "w+");

//生成一百个100以内的3个数加减法
geneTest(100,100,3,$myfile,$answer);

fclose($myfile);
fclose($answer);
echo "<h3 style='margin-top: 50px;text-align: center'>100以内加减法试题已生成</h3>";
echo "<h3 style='margin-top: 50px;text-align: center'>请不要刷新，刷新即换另一套试题，可保存在本地使用</h3>";
echo "<a href='test.txt' style='margin-top: 50px;text-align: center;display: block'>查看试题</a>";
echo "<a href='answer.txt' style='margin-top: 50px;text-align: center;display: block'>查看答案</a>";
echo "<h3 style='margin-top: 300px;text-align: center'>感兴趣的同学可访问，可把代码下载至本地</h3>";

//生成试卷 $n 多少个 $m 多少以内
function geneTest($n,$m,$j,$myfile,$answer){
    for($i=0;$i<$n;$i++){
        $numbers = numberFactory($m,$j,symbol());



        //试题
        fwrite($myfile,"\t");
        fwrite($myfile,implode('',$numbers));
        fwrite($myfile,"\t\t\t\t");
        if($i%2==1){
            fwrite($myfile,"\n");
        }
        //答案
        $numbers= answer($numbers);
        fwrite($answer,"\t");
        fwrite($answer,implode('',$numbers));
        fwrite($answer,"\t\t\t\t");
        if($i%2==1){
            fwrite($answer,"\n");
        }




    }
}

//求答案

function answer($numbers){
    $temp  = [];
    foreach ($numbers as $k=>$v){
        if($k==0){
            $temp [] = $v;
            continue;
        }
        if($k%2==0){
            $temp [] = $numbers[$k-1].$v;
        }
    }
    $numbers[] = array_sum($temp);
    return $numbers;
}
//符号
function symbol(){
    $symbols = ['+-'];
    $symbol = $symbols[array_rand($symbols)];
    return $symbol;

}

//生成字符串 9+10=
function numberFactory($num=100,$j,$symbol='+-'){

    switch ($symbol){
        case '+-':
            return insertSymbol(jiaJian($num,$j),'+-');
        case '+':
            return insertSymbol(jia($num,$j),'+');
        case '-':
            return insertSymbol(jian($num,$j),'-');
    }
}


function jiaJian($num,$j){
    $arr=[];
    for($i=0;$i<$j;$i++){

            $arr[] = rand(1,$num);

    }
    return $arr;

}
//生成j个加数
function jia($num,$j){
    $arr =[];
    for($i=0;$i<$j;$i++){
        $arr[] = rand(1,$num);
    }

    return $arr;
}
//生成j个减数
function jian($num,$j){

    $arr =[];
    for($i=0;$i<$j;$i++){
        $arr[] = rand(1,$num);
    }
    return $arr;
}

//插入符号到生成的两个数中
function insertSymbol($array,$symbol){
    if(empty($array)){
        throw new Exception('获取数组错误');
    }
    switch ($symbol){
        case '+-':
            $symbols = ['+','-'];
            return pingJieSymbol($array,$symbols);
        case '+':
            $symbols = ['+'];
            return pingJieSymbol($array,$symbols);
        case '-':
            $symbols = ['-'];
            return pingJieSymbol($array,$symbols);
    }


}

//拼接符号至生成的两个数中
function pingJieSymbol($array,$symbols){
    $arrayTemp = [];
    foreach ($array as $k=>$v){
        $symbol = $symbols[array_rand($symbols)];
        $arrayTemp[] = $v;
        $arrayTemp[] = $symbol;
    }
    $arrayTemp[count($arrayTemp)-1] = '=';
    return $arrayTemp;

}



?>
