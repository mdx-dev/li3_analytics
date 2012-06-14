<!-- Version: Webtrends 9.4.0 -->
<script src="<?php echo $tracking->script(); ?>" type="text/javascript"></script>

<script type="text/javascript">
	//<![CDATA[
	var _tag=new WebTrends();
	//]]>
</script>

<script type="text/javascript">
	//<![CDATA[
	_tag.dcsCustom=function(){
	// Add custom parameters here.
	//_tag.DCSext.param_name=param_value;
	}
	_tag.dcsCollect();
	//]]>
</script>

<noscript>
	<div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="<?php echo $tracking->uri(); ?><?php echo $tracking->key(); ?>/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;DCS.dcscfg=1&amp;WT.tv=<?php echo $tracking->version(); ?>&amp;dcssip=<?php echo $tracking->domain(); ?>"/></div>
</noscript>
<!-- END OF SmartSource Data Collector TAG -->