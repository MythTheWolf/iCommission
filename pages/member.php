<?php include_once $_SERVER['DOCUMENT_ROOT'].'/lib/bootstrap.php';?>
		<div id="page-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Overdue/Upcoming commissions</h1>
					</div>
				</div>
				<!-- /.row -->

				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive" id="dashboard-upcoming"></div>
					</div>
				</div>
				<!-- /.row -->

			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- /#page-wrapper -->


	
</body>

<script src="/JS/pageScripts/Member/queryComissions.js"></script>
<script>

	function getUrlParam(sParam) {
	    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
	        sURLVariables = sPageURL.split('&'),
	        sParameterName,
	        i;

	    for (i = 0; i < sURLVariables.length; i++) {
	        sParameterName = sURLVariables[i].split('=');

	        if (sParameterName[0] === sParam) {
	            return sParameterName[1] === undefined ? true : sParameterName[1];
	        }
	    }
	}
	 var LOAD = getUrlParam("load");
	 if(LOAD == null || LOAD === ""){
		 LOAD = "default";
	 }
	 
	</script>

</body>
<div id="dialog" name="dialog" title="A error has occured" hidden>
	<p>This is the default dialog which is useful for displaying
		information. The dialog window can be moved, resized and closed with
		the 'x' icon.</p>
</div>

</html>
