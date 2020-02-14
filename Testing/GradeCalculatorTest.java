import static org.junit.jupiter.api.Assertions.*; 
import org.junit.jupiter.api.Test;
import org.junit.jupiter.params.ParameterizedTest;
import org.junit.jupiter.params.provider.CsvSource; 

class GradeCalculatorTest { 
@ParameterizedTest(name = "{index} Score {0}, is Grade {1}") 
@CsvSource({
"-1, INVALID SCORE",
"0, F",
"59, F",
"60, D",
"69, D",
"70, C",
"79, C",
"80, B",
"89, B",
"90, A",
"99, A",
"100, A",
"101, INVALID SCORE", 
}) 
void testCheck(int score, String expectedResult) {
GradeCalculator calc = new GradeCalculator(); 

String result = calc.ScoreToGrade(score); assertEquals(expectedResult, result);

} 
}