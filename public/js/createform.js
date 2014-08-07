var tasks = 0;
var shown = false;

var times = ['morning', 'midday', 'afternoon', 'evening', 'end of day']

var duePickers = [];

$('#createName').keypress(function() {
	if(!shown) {
    	$('#createSection2').fadeIn();
		shown=true;
	}
});

$("#createDoneAddingButton").click(function() {
	if(!validateTasks()) 
		return;
	
	$(".taskItem").each(function(i) {
		if(i!=0) {
			$("#assignTasksArea").append($("#assignTasksFormat").html());
			$(".assignDescription").last().text($("input[name='description[]']").eq(i).val());
			$(".assignDuration").last().text($("input[name='duration[]']").eq(i).val() + " " 
											+ $("select[name='durationUnit[]']").eq(i).val());
			$(".assignDue").last().text(duePickers[i-1].last().val() + " " 
											+ times[1*$("select[name='dueTime[]']").eq(i).val()]);
			$(".dateField").last().pickadate({
				format: 'ddd, mmm d, yyyy',
				formatSubmit: 'yyyy/mm/dd',
				hiddenPrefix: 'submit_',
				hiddenSuffix: '',
				min: new Date()
			})
		}
	});
	
	$('#createSection2').hide();
	$('#createSection3').fadeIn();
});

$("#createNewTaskButton").click(function() {
	$("#createTasksArea").append($("#createTaskFormat").html());
	duePickers.push($('.dateField').pickadate({
		format: 'ddd, mmm d, yyyy',
		formatSubmit: 'yyyy/mm/dd',
		hiddenPrefix: 'submit_',
		hiddenSuffix: '',
		min: new Date()
	}));
	tasks++;
	$("#createDoneAddingButton").show();
});

function validateTasks() {
	$valid = true;
	$errors = "";
	$('.numberInput').each(function(i) {
		if(i!=0 && !$.isNumeric($(this).val())) {
			$valid = false;
			$errors = $errors + 'Estimated time needed for task ' + i + " must be a number<br />";
		}
	});
	$('.textField').each(function(i) {
		if(i!=0 && $(this).val() == "") {
			$valid = false;
			$errors = $errors + 'Your description for task ' + i + " is missing<br />";
		}
	});
	
	if(!$valid) {
		$("#formErrors").html($errors);
		$("#formErrors").show();
	} else {
		$("#formErrors").hide();
	}
	
	return $valid;
}