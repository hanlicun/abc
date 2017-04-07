<?php
//插入排序算法

$numbers = array(
	31,41,59,26,32,58,321,21,4,43,44,99
);



function insertion($arr){
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

var_dump(insertion($numbers));

