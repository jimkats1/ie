function formCheck()
{
	var returner = qCheck();
	if(returner == false)
	{
		return false;
	}
	var returner = SCP();
	return returner;
}
function qCheck()
{
	var questions = document.getElementsByClassName("question");
	var textQuestions = document.getElementsByClassName("textquestion");
	for(var i=0;i<questions.length;i++)
	{
		if(isInt(questions[i].value))
		{
			if(questions[i].value < 1)
			{
				alert("Συμπληρώστε όλα τα πεδία!");
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	for(var i=0;i<textQuestions.length;i++)
	{
		if(textQuestions[i] == null || textQuestions[i] == "")
		{
			alert("Συπληρώστε όλα τα πεδία!");
			return false;
		}
	}
	return true;
}
function SCP()
{
	var semester = document.getElementById("semester");
	var course = document.getElementById("course");
	var prof = document.getElementById("prof");
	
	if(semester.value == "" || semester.value == null || semester.value == -1)
	{
		alert("Συμπληρώστε όλα τα πεδία!");
		return false;
	}
	else if(course.value == "" || course.value == null || course.value == -1)
	{
		alert("Συμπληρώστε όλα τα πεδία!");
		return false;
	}
	else if(prof.value == "" || prof.value == null || prof.value == -1)
	{
		alert("Συμπληρώστε όλα τα πεδία!");
		return false;
	}
	return true;
}
function isInt(x) 
{
  var y=parseInt(x);
  if (isNaN(y)) return false;
  return true;
}
