var tasks = 0;

$('#createName').keypress(function() {
    $('#createSection2').show();
});

$("#createDoneAddingButton").click(function() {
	
});

$("#createNewTaskButton").click(function() {
	$("#createTasksArea").append($("#createTaskFormat").html());
	$("input[name='due[]']").datepicker();
	tasks++;
	$("#createDoneAddingButton").show();
});