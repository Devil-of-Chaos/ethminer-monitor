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
					<div class='feature-box'>";
	if ($return['ONLINE'] === true){
		print "
						<div class='feature-head'>".$return['MINER']."</div><!-- /.feature-head -->
						<div class='feature-content'>
							<ol>
								<li><span>Version </span><span class='strong' id='".$return_key."_STATS_VERSION'>".$return['STATS']['VERSION']."</span></li>
								<li><span>Uptime </span><span class='strong' id='".$return_key."_STATS_UPTIME'>".$return['STATS']['UPTIME']."</span></li>
								<li><span>Hashrate </span><span class='strong' id='".$return_key."_STATS_HASHRATE'>".$return['STATS']['HASHRATE']."</span></li>
							</ol>
						</div><!-- /.feature-content -->
						<a href='/miner/".$h->url_slug($return['MINER']).",".$return['ID'].".html' class='btn' title='".$return['MINER']."' >".$return['MINER']."</a>";
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