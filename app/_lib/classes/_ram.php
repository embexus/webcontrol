<?php
	class ramPercentage {
		function freeMemory($statsOnly = 0){
		    exec('free', $out);
		    preg_match_all('/\s+([0-9]+)/', $out[1], $matches);
		    list($total, $used, $free, $shared, $buffers, $cached) = $matches[1];

			$percentage = round(($used - $buffers - $cached) / $total * 100);
			
			if($percentage > '80'){
			    $warning = "<img src=\"_lib/images/warning.png\" height=\"18\" />";
			    $bar = "barAmber";
	          } else {
	            $warning = "<img src=\"_lib/images/ok.png\" height=\"18\" />";
	            $bar = "barGreen";
	          } 
			  if ($statsOnly) {
				echo '"ram" : {
					"free" : '.($free + $buffers + $cached).',
					"used" : '.($used - $buffers - $cached).',
					"total" : '.$total.'
				}';
				//echo '{"free" : '.($free+$buffers+$cached).'}';
				return;
			  }
	          ?>
		
		
				<div class="ramIcon">
					<img src="_lib/images/memory.png" align="middle">
				</div>
				
				<div class="ramTitle">
					 Memory 
				</div>
				
				<div class="ramWarning">
					<?php echo $warning; ?>
				</div>
				
				<div class="ramText">
					<div class="graph">
						<strong class="<?php echo $bar; ?>" style="width:<?php echo $percentage; ?>%;"><?php echo $percentage; ?>%</strong>
					</div> 
					
					<div class="clear"></div>
					
					<br/>
					
					Free: <strong><?php echo round(($free + $buffers + $cached)/1024); ?> MB</strong> Used: <strong><?php echo round(($used - $buffers - $cached)/1024); ?> MB</strong> &middot Total: <strong><?php echo round($total/1024); ?> MB</strong><br/></div>
				
				
				<div class="clear"></div>
				
	<?php
		}

		function freeSwap($statsOnly = 0){
		    exec('free -mo', $out);
		    preg_match_all('/\s+([0-9]+)/', $out[2], $matches);
		    list($total, $used, $free) = $matches[1];
		    
		    $percentage = round($used / $total * 100);

			if($percentage > '80'){
			    $warning = "<img src=\"_lib/images/warning.png\" height=\"18\" />";
			    $bar = "barAmber";
	          } else {
	            $warning = "<img src=\"_lib/images/ok.png\" height=\"18\" />";
	            $bar = "barGreen";
	          } 
			  if ($statsOnly) {
				echo '"swap" : {
					"free" : '.$free.',
					"used" : '.$used.',
					"total" : '.$total.'
				}';
				return;
			  }
	          ?>
		
				
<?php
		}
		}
