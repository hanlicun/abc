<?php

//�����򣨶Լ�ѡ������ĸĽ���

function swap(array &$arr,$a,$b){
    $temp = $arr[$a];
    $arr[$a] = $arr[$b];
    $arr[$b] = $temp;
}

//���� $arr[$start]�Ĺؼ��֣�ʹ$arr[$start]��$arr[$start+1]������$arr[$end]��Ϊһ������ѣ����ڵ�������ȫ��������
//ע������ڵ� s �����Һ����� 2*s + 1 �� 2*s+2 �����鿪ʼ�±�Ϊ 0 ʱ��
function HeapAdjust(array &$arr,$start,$end){
    $temp = $arr[$start];
    //�عؼ��ֽϴ�ĺ��ӽڵ�����ɸѡ
    //���Һ��Ӽ��㣨���������鿪ʼ�±�ʶ 0��
    //����2 * $start + 1���Һ���2 * $start + 2
    for($j = 2 * $start + 1;$j <= $end;$j = 2 * $j + 1){
        if($j != $end && $arr[$j] < $arr[$j + 1]){
            $j ++; //ת��Ϊ�Һ���
        }
        if($temp >= $arr[$j]){
            break;  //�Ѿ���������
        }
        //�����ڵ�����Ϊ�ӽڵ�Ľϴ�ֵ
        $arr[$start] = $arr[$j];
        //��������
        $start = $j;
    }
    $arr[$start] = $temp;
}

function HeapSort(array &$arr){
    $count = count($arr);
    //�Ƚ����鹹��ɴ����
	//����������ȫ������������������floor($count/2)-1��
	//�±�С�ڻ���������Ľڵ㶼���к��ӵĽڵ�)
	$start = floor($count / 2) - 1;
    for($i = $start;$i >= 0;$i --){
        HeapAdjust($arr,$i,$count);
    }
    for($i = $count - 1;$i >= 0;$i --){
        //���Ѷ�Ԫ�������һ��Ԫ�ؽ�������ȡ�����Ԫ�أ�����������һ��Ԫ�أ��������Ԫ�طŵ�����ĩβ
        swap($arr,0,$i);  
        //���������������һ��Ԫ�أ����Ԫ�أ��������ѣ�����δ�����������($arr[0...$i-1])���µ���Ϊ�����
        HeapAdjust($arr,0,$i - 1);
    }
}

$arr = array(9,1,5,8,3,7,4,6,2);
HeapSort($arr);
var_dump($arr);


