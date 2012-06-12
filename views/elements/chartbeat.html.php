<?php

	$configuration = "";
	$config = $tracking->config();
	
	array_walk($config, function($item, $key) use (&$configuration){
		$_type = gettype($item);
		$configuration .= "\t_sf_async_config.{$key} = ";
		$configuration .= ($_type == 'string') ? "\"{$item}\";\n" : "{$item};\n";
	});

?>

<script type="text/javascript">
	var _sf_async_config={};
	/** CONFIGURATION START **/
	<?php echo $configuration; ?>
	/** CONFIGURATION END **/
	(function(){
		function loadChartbeat() {
			window._sf_endpt=(new Date()).getTime();
			var e = document.createElement("script");
			e.setAttribute("language", "javascript");
			e.setAttribute("type", "text/javascript");
			e.setAttribute("src",
				 (("https:" == document.location.protocol) ?
					 "https://a248.e.akamai.net/chartbeat.download.akamai.com/102508/" :
					 "http://static.chartbeat.com/") +
				 "js/chartbeat.js");
			document.body.appendChild(e);
		}
		var oldonload = window.onload;
		window.onload = (typeof window.onload != "function") ?
			 loadChartbeat : function() { oldonload(); loadChartbeat(); };
	})();
</script>