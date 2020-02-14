public class GradeCalculator {

public String ScoreToGrade(int score) {

String grade = ""; if (score >100 || score < 0) 
{grade = "INVALID SCORE"; 
}else if(score>=90) { 
	grade = "A"; 
	} else if(score>=80) {
	grade = "B"; 
	} else if(score>=70) {
	grade = "C"; } 
	else if(score>=60) { 
	grade = "D"; 
	} else { 
	grade = "F";
	} 
return grade; 
	}
}