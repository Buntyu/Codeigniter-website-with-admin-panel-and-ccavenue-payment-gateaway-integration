<?php

?>
<script>
	function customTableEvent()
	{
		$(".viewbtn").live
		(
			"click",
			function(e)
			{
				e.preventDefault();
				var height = 600;
				var top = (window.innerHeight - height)/2;
				var width = 1000;
				var left = (window.innerWidth - width)/2;
				window.open($(this).attr("href"),"Sales Invoice","height="+height+",top="+top+",width="+width+",left="+left+",menubar=1,titlebar=0,toolbar=0,fullscreen=0");
			}
		);
	}
</script>

<script>
function customTableEvent()
{
	$(".datatable th:first-child").trigger("click");
}
</script>