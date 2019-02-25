<?php

// 学生信息
$userInfo = [
	'mobile' => '13261299903',
    'user_name' => '黑子恒',
    'mount' => 12,   // 月份
    'cardNum' => 5341,   // 卡号后四位
    'salary' => 10821.24,  // 工资
    'balance_num' => 12034.74, //当前余额
    'max_day_amount' => 95,  // 每天最大消费金额
    'salary_day' => 15,  // 发工资的日子
    'salary_time' => '11:10', // 发工资的时间
    'company' => '北京零号元素科技有限公司',
];

// 本月支出金额
$userInfo['pay_amount'] = 0;
// 本月收入金额
$userInfo['income_amount'] = $userInfo['salary'];
// 累计金额
$userInfo['grand_total'] = $userInfo['balance_num'];

// 获取单笔交易明细
function getList()
{
	global $userInfo;

	$consumeList = [
        [
            'title' => '支付宝-黑子恒',
            'description' => '网络购物<span class="interval"></span>储蓄卡'.$userInfo['cardNum'],
			'icon' => 2
        ],
        [
            'title' => '（特约）京东支付',
            'description' => '网络购物<span class="interval"></span>储蓄卡'.$userInfo['cardNum'],
			'icon' => 2
        ],
		[
			'title' => '财付通-微信红包',
			'description' => '红包',
			'icon' => 3
		]
    ];

    $time = mt_rand(10,23).':'.mt_rand(10,60).':'.mt_rand(10,60);
    $info = $consumeList[mt_rand(0,1)];
	if(strpos($info['description'], '红包') === false){
		$info['description'] = $info['description'].' '.$time.'...';
	}else{
    	$info['description'] = $info['description'].' '.$time;
	}
    $info['amount'] = randomFloat(10, 50);
    $info['status'] = 'expend';
    $info['time'] = $time;

    return $info;
}

// 获取随机小数
function randomFloat($min = 0, $max = 10)
{
    $num = $min + mt_rand() / mt_getrandmax() * ($max - $min);
    return sprintf("%.2f", $num);

}

// 排序并设置金额
function orderList($list, $nowTime){
	global $userInfo;

	$isSalary = 0;
	$time = array_column($list, 'time');
	array_multisort($time, SORT_DESC, $list);

	$payAmount = 0;
	for($i = 0; $i<count($list); $i++){
		if($payAmount >= $userInfo['max_day_amount'] && date('d', $nowTime) != 15){
			unset($list[$i]);
			break;
		}

		$info = $list[$i];
		$info['balance_num'] = $userInfo['grand_total'];
		if(isset($info['payer'])){
			$grandTotal = $userInfo['grand_total']-$info['amount'];
			// $userInfo['grand_total'] -= $info['amount'];
		}else{
			$grandTotal = $userInfo['grand_total']+$info['amount'];
			// $userInfo['grand_total'] += $info['amount'];
			$userInfo['pay_amount'] += $info['amount'];
	        $userInfo['pay_amount'] = sprintf("%.2f", $userInfo['pay_amount']);
    	    $payAmount += $info['amount'];
		}
		$userInfo['grand_total'] = sprintf("%.2f", $grandTotal);

    	$info['amount'] = number_format($info['amount'], 2);
    	$info['balance_num'] = number_format($info['balance_num'], 2);
    	$list[$i] = $info;
	}

	return $list;
}

// 获取工资信息
function getSalaryDetail()
{
	global $userInfo;

	$time = $userInfo['salary_time'];
	$info['title'] = '网上代发代扣';
    $info['description'] = '工资福利<span class="interval"></span>储蓄卡'.$userInfo['cardNum'].' '.$time.'...';
    $info['amount'] = $userInfo['salary'];
    $info['status'] = 'income';
    $info['payer'] = $userInfo['company'];
    $info['time'] = $time;
	$info['icon'] = 4;

    return $info;
}

$type = isset($_GET['t']) ? $_GET['t'] : 'list';
$fileName = './'.$userInfo['mobile'].'.txt';

if($type == 'detail'){
	$result = [
		'salary' => $userInfo['salary'],
		'card_num' => $userInfo['cardNum'],
		'company' => $userInfo['company'],
		'time' => date('Y', time()).'-'.$userInfo['mount'].'-'.$userInfo['salary_day'].' '.$userInfo['salary_time'].':'.mt_rand(10,60)
	];
	
	$fileData = json_decode(file_get_contents($fileName), true);
	foreach($fileData['data'] as $key => $value){
		foreach($value['list'] as $item){
			if(isset($item['payer'])){
				$result['balance_num'] = $item['balance_num'];
				break;
			}
		}
	}	

	echo json_encode($result);die;
}

if($type == 'welcome'){
	$hour = date('H');
	if($hour<13){
		$timeQuantum = '上午好';
	}else if($hour<18){
		$timeQuantum = '下午好';
	}else{
		$timeQuantum = '晚上好';
	}
	$result = [
		'mobile1' => substr($userInfo['mobile'], 0, 3),
		'mobile2' => substr($userInfo['mobile'], -3),
		'time_quantum' => $timeQuantum 
	];

	echo json_encode($result);die;
}

if($type == 'my'){
	$result = [
		'user_name' => $userInfo['user_name'],
		'balance_num' => number_format($userInfo['balance_num'], 2)
	];

	echo json_encode($result);die;
}

if($type == 'list'){
	if(file_exists($fileName)){
		$result = json_decode(file_get_contents($fileName));
	}else{
		$nowTime = strtotime(date('Y-m-d'));
	    $stopDay = 1;
	    $listData = [];
	    while(true){
	    	$nowDay = date('d', $nowTime);
	        $dateTime = date('m月d日', $nowTime);
	        if($nowDay == $userInfo['salary_day']){
	            $data['date'] = $dateTime;
	            $data['list'] = [];
	            $num = mt_rand(2,4);
	            for($i = 0;$i<$num;$i++){
	                $data['list'][] = getList();
	            }
	            $info = getSalaryDetail();
	            $data['list'][mt_rand(0, count($data['list']))] = $info;
	        }else{
	            $randNum = mt_rand(1,100);
	            if($randNum>50){
	                $data['date'] = $dateTime;
	                $data['list'] = [];
	                $num = mt_rand(1,4);
	                for($i = 0;$i<$num;$i++){
	                    $data['list'][] = getList();
	                }
	            }
	        }
	        if(isset($data)){
	        	$data['list'] = orderList($data['list'], $nowTime);
	        	$listData[] = $data;
	            unset($data);
	        }
	        $nowTime = $nowTime-3600*24;
	        if($stopDay == date('d', $nowTime)){
	            break;
	        }
	    }

	    $result = [
	    	'pay_amount' => number_format($userInfo['pay_amount'], 2),
	    	'income_amount' => number_format($userInfo['income_amount'], 2),
	    	'balance_num' => number_format($userInfo['balance_num'], 2),
	    	'data' => $listData
	    ];

	    file_put_contents($fileName, json_encode($result));
	}

    echo json_encode($result);die;
}
