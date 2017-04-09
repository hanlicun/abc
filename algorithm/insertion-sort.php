<?php
//插入排序算法

$numbers = array(
	31,41,59,26,32,58,321,21,4,43,44,99
);



function insertion_sort($arr){
	$len = count($arr);
	for($j=1;$j<$len;$j++){
		$key = 	$arr[$j];
		$i = $j -1;
		while($i>=0&&$arr[$i]>$key){
		 $arr[$i+1] = $arr[$i];
		 $i = $i -1  ;
		 $arr[$i+1] =  $key;
		}
	}
	return $arr;
}


//时间复杂度0(n^2)



function getCurrentTime ()  {  
    list ($msec, $sec) = explode(" ", microtime());  
    return (float)$msec + (float)$sec;  
}  

$begin = getCurrentTime();  

//do some test:

function get_rand_number($start=1,$end=10,$length=4){  
    $connt=0;  
    $temp=array();  
    while($connt<$length){  
        $temp[]=mt_rand($start,$end);  
        $data=array_unique($temp);  
        $connt=count($data);  
    }  
    sort($data);  
    return $data;  
}  
$numbers = get_rand_number(1,100000,2000);

$res = insertion_sort($numbers);


$end = getCurrentTime();  
$spend = $end - $begin;  
echo "runtime:".$spend."\n";
//print_r($res);