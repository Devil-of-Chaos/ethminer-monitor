<?php
if ($class == 'grey') $class = NULL;
else $class = 'grey';
print "
<div class='row ".$class."'>
	<div class='shell'>
		<div class='col col-4of4'>
			<ul class='feature'>";
foreach ($return_data AS $return_key => $return){
	print "
				<li>
					<div class='feature-box large'>";
	if ($return['ONLINE'] === true){
		print "
						<div class='feature-head'>".$return['MINER']."</div><!-- /.feature-head -->
						<div class='feature-content'>
							<ol>
								<li><span>Version </span><span class='strong' id='".$return_key."_STATS_VERSION'>".$return['STATS']['VERSION']."</span></li>
								<li><span>Uptime </span><span class='strong' id='".$return_key."_STATS_UPTIME'>".$return['STATS']['UPTIME']."</span></li>
								<li><span>Hashrate </span><span class='strong' id='".$return_key."_STATS_HASHRATE'>".$return['STATS']['HASHRATE']."</span></li>
								<li><span>Pool </span><span class='strong' id='".$return_key."_STATS_POOL'>".$return['STATS']['POOL']."</span></li>
							</ol>
						</div><!-- /.feature-content -->";
	} else {
		print "
						<div class='feature-head'>".$return['MINER']."</div><!-- /.feature-head -->";
	}
	print "
					</div><!-- /.feature-box -->
				</li>
				<li>
					<div class='feature-box large'>";
	if ($return['ONLINE'] === true){
		print "
						<div class='feature-head'>".$return['MINER']."</div><!-- /.feature-head -->
						<div class='feature-content'>
							<ol>
								<li><span>Submitted Shares </span><span class='strong' id='".$return_key."_STATS_SUBMITTED'>".$return['STATS']['SUBMITTED']."</span></li>
								<li><span>Rejected Shares </span><span class='strong' id='".$return_key."_STATS_REJECTED'>".$return['STATS']['REJECTED']."</span></li>
								<li><span>Invalid Shares </span><span class='strong' id='".$return_key."_STATS_INVALID'>".$return['STATS']['INVALID']."</span></li>
								<li><span>Pool Switches </span><span class='strong' id='".$return_key."_STATS_SWITCHES'>".$return['STATS']['SWITCHES']."</span></li>
							</ol>
						</div><!-- /.feature-content -->";
	} else {
		print "
						<div class='feature-head'>".$return['MINER']."</div><!-- /.feature-head -->";
	}
	print "
					</div><!-- /.feature-box -->
				</li>";
}
print "
			</ul><!-- /.feature -->
		</div><!-- /.col -->
	</div><!-- /.shell -->
</div><!-- /.row -->";


if ($class == 'grey') $class = NULL;
else $class = 'grey';
print "
<div class='row ".$class."'>
	<div class='shell'>
		<div class='col col-4of4'>
			<ul class='feature'>";
foreach ($return_data AS $return_key => $return){
	$col = 0;
	$i=1;
	foreach ($return['GPU'] AS $gpu_key => $gpu){
		if ($col % 4 == 0){
			print "
<div class='row ".$class."'>
	<div class='shell'>
		<div class='col col-4of4'>
			<ul class='feature'>
			</ul><!-- /.feature -->
		</div><!-- /.col -->
	</div><!-- /.shell -->
</div><!-- /.row -->";
			$col = 0;
		}
		print "
				<li>
					<div id='".$return_key."_GPU_".$gpu_key."_GPUBOX' class='feature-box ";
		if ($gpu['ISPAUSED'] == 1) print "paused";
		elseif($gpu['MATH_HASHRATE'] == 0) print "error";
		else print "online";
		print "'>
						<div class='feature-head'>GPU ".$i." Index ".$gpu_key."</div><!-- /.feature-head -->
						<div class='feature-content'>
							<ol>
								<li><span>Hashrate </span><span class='strong' id='".$return_key."_GPU_".$gpu_key."_HASHRATE'>".$gpu['HASHRATE']."</span></li>
								<li><span>Temperature </span><span class='strong' id='".$return_key."_GPU_".$gpu_key."_TEMP'>".$gpu['TEMP']."</span></li>
								<li><span>Fan </span><span class='strong' id='".$return_key."_GPU_".$gpu_key."_FAN'>".$gpu['FAN']."</span></li>";
		if ($gpu['POWER']){
			print "
								<li><span>Power </span><span class='strong' id='".$return_key."_GPU_".$gpu_key."_POWER'>".$gpu['POWER']."</span></li>";
		}
		print "
							</ol>
						</div><!-- /.feature-content -->
						<div class='feature-footer'>";
		if ($gpu['ISPAUSED'] == 1) print "<a href='#' data-id='".$gpu_key."' data-toggle='activate' class='toggle_gpu'>activate</a>";
		else  print "<a href='#' data-id='".$gpu_key."' data-toggle='deactivate' class='toggle_gpu'>deactivate</a>";
		print "
						</div><!-- /.feature-footer -->
					</div><!-- /.feature-box -->
				</li>";
		$col ++;
		$i++;
	}
}
print "
			</ul><!-- /.feature -->
		</div><!-- /.col -->
	</div><!-- /.shell -->
</div><!-- /.row -->";
