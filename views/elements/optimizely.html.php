<!-- Start Optimizely code -->
<script type="text/javascript">
(function() {
	var projectId = '<?php echo $tracking->key(); ?>';
	var protocol = ('https:' == document.location.protocol ? 'https://' : 'http://');
	var scriptTag = document.createElement('script');
	scriptTag.type = 'text/javascript';
	scriptTag.async = true;
	scriptTag.src = protocol + 'cdn.optimizely.com/js/' + projectId + '.js';
	var head = document.getElementsByTagName('head')[0];
	head.parentNode.insertBefore(scriptTag, head);
})();
</script>
<!-- End Optimizely code -->