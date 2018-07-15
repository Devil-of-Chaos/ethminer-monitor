<?php
if ($config['ID'] == $id){
	$miner = new socket($config['host'], $config['port'], $timeout);
	$ping_msg = $miner->returnArray('miner_ping');
	if (isset($ping_msg['result']) && $ping_msg['result'] == 'pong'){
		$return_data[$config_key]['ONLINE'] = true;
		$miner_data = $miner->returnArray('miner_getstat1');
		if (is_array($miner_data['result'])){
			$miner_data2 = $miner->returnArray('miner_getstathr');
			$mining_stats = explode(';', $miner_data['result'][2]);
			$gpu_hashrate = explode(';', $miner_data['result'][3]);
			$gpu_data = explode(';', $miner_data['result'][6]);
			$pool_data = explode(';', $miner_data['result'][8]);
			
			$return_data[$config_key]['STATS']['VERSION'] = $miner_data['result'][0];
			$return_data[$config_key]['STATS']['UPTIME'] = $h->formatTime($miner_data['result'][1]);
			$return_data[$config_key]['STATS']['HASHRATE'] = $h->formatHashrate($mining_stats[0]);
			$return_data[$config_key]['STATS']['SUBMITTED'] = $mining_stats[1];
			$return_data[$config_key]['STATS']['REJECTED'] = $mining_stats[2];
			$return_data[$config_key]['STATS']['POOL'] = $miner_data['result'][7];
			$return_data[$config_key]['STATS']['INVALID'] = $pool_data[0];
			$return_data[$config_key]['STATS']['SWITCHES'] = $pool_data[1];
			
			$y = 0;
			foreach ($gpu_hashrate AS $i => $gpu){
				$return_data[$config_key]['GPU'][$i]['HASHRATE'] = $h->formatHashrate($gpu);
				$return_data[$config_key]['GPU'][$i]['TEMP'] = $gpu_data[$y]." °C";
				$y++;
				$return_data[$config_key]['GPU'][$i]['FAN'] = $gpu_data[$y]."%";
				$y++;
				if (is_array($miner_data2['result'])){
					$return_data[$config_key]['GPU'][$i]['POWER'] = number_format($miner_data2['result']['powerusages'][$i], 2, ".", "")." Watt";
					$return_data[$config_key]['GPU'][$i]['ISPAUSED'] = $miner_data2['result']['ispaused'][$i];
				}
			}
			
		} else {
			$return_data[$config_key]['ONLINE'] = false;
		}
	} else {
		$return_data[$config_key]['ONLINE'] = false;
	}
	
	if (is_string($config_key)){
		$return_data[$config_key]['MINER'] = $config_key;
	} else {
		$return_data[$config_key]['MINER'] = $config['host'];
	}
	
	$return_data[$config_key]['ID'] = $config['ID'];
}