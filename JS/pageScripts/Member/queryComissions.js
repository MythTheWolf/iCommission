function bind(result) {
	// alert(result);
	$("#editButton").click(function() {
		var ID = $(this).attr("name");
		var obj = JSON.parse(result);

	});
}
(function() {

	var d = new Date();
	var curr_date = d.getDate();
	var curr_month = d.getMonth() + 1; // Months are zero based
	var curr_year = d.getFullYear();
	$("#currentDate").val(curr_month + "/" + curr_date + "/" + curr_year);

	$
			.ajax({
				type : "POST",
				url : "/lib/API/getDashboardStats.php",
				data : $("#fieldVars").serialize(),
				success : function(result) {
					if (result.indexOf("Warning") == 999
							|| result.indexOf("Fatal") > -1
							|| result.indexOf("error") > -1) {
						$("#dialog").html(result);
						$("#dialog").dialog();
					} else {
						$("#dashboard-upcoming").html("Nothing here yet!");
						var obj = JSON.parse(result);
						$("#COMM_REQUESTS").html(
								"Commission reqests <span class=\"label label-danger\">"
										+ obj.numUnansweredRequets + "</span>");
						if (obj.numPastDue > 0) {

							$("#dashboard-link")
									.html(
											"<i class=\"fa fa-fw fa-dashboard\"></i> Dashboard</a> <span class=\"label label-danger\">!</span>");
						} else {

						}
						if (obj.overDues.length > 0) {
							var base = "<table class=\"table table-hover\" id=\"upcoming\">    <thead>      <tr> <th>Action</th>        <th>Project name</th>        <th>User</th>        <th>Catagory</th> <th>Description</th>  <th>Step</th>     <th>Expected due date</th> </tr>    </thead>    <tbody>";
							var suffix = "";
							var arrayLength = obj.overDues.length;
							for (var i = 0; i < arrayLength; i++) {
								if (obj.overDues[i].isWarning == "true") {
									suffix = suffix
											+ "<tr class=\"warning\"> <td><button type=\"button\" class=\"btn btn-primary\" id=\"editButton\" name=\" "
											+ obj.overDues[i].id
											+ "\">Edit..</button></td><td>"
											+ obj.overDues[i].name
											+ "</td><td>"
											+ obj.overDues[i].endUser
											+ "</td><td>"
											+ obj.overDues[i].catName
											+ "</td><td>"
											+ obj.overDues[i].desc
											+ "</td><td>"
											+ obj.overDues[i].stepName
											+ "</td><td>"
											+ obj.overDues[i].projectedEnd
											+ "</td>";
									// Do something
								} else {
									suffix = suffix
											+ "<tr class=\"danger\"> <td><button type=\"button\" class=\"btn btn-primary\" id=\"editButton\" name=\" "
											+ obj.overDues[i].id
											+ "\">Edit..</button></td><td>"
											+ obj.overDues[i].name
											+ "</td><td>"
											+ obj.overDues[i].endUser
											+ "</td><td>"
											+ obj.overDues[i].catName
											+ "</td><td>"
											+ obj.overDues[i].desc
											+ "</td><td>"
											+ obj.overDues[i].stepName
											+ "</td><td>"
											+ obj.overDues[i].projectedEnd
											+ "</td>";
								}
							}
							$("#dashboard-upcoming").html(
									base + suffix + "</tbody></table>");
							bind(result);
						}
					}
				}

			});
	setTimeout(arguments.callee, 1000);
})();