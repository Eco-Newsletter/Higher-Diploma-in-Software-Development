
package Pokerfx;
/*A card class that creates a card with a value and a suit
 * 
 */
public class Card {
 
  //a 2 d array to store the possible values and suits
	private String[][] valueandsuit;
// value and suit fields
	private String rank;
	private String suit;
//indexes used to choose the value and suit
	int rankIndex;
	int suitIndex;
////////////////////////////////////////////////////////////////////////////////////////////
	/*CONSTRUCTOR
	 * Takes in 2 integers representing the suit and rank
	 * initializes the card object with this suit and rank
	 * 
	 */
	
public Card(int suitIndex, int valueIndex) {
	
	this.suitIndex= suitIndex;
	this.rankIndex= valueIndex;
	valueandsuit = new String [][]{{"Hearts", "Diamonds", "Spades", "Clubs"},
	 							   {"Ace of ","2 of ","3 of ","4 of ","5 of ","6 of ","7 of ","8 of ","9 of ","10 of ","Jack of ","Queen of ","King of "}};
	this.suit = valueandsuit[0][suitIndex];
	this.rank = valueandsuit[1][valueIndex];
}
////////////////////////////////////////////////////////////////////////////////////////
/*method to get the suit as a String
 * @return String
 */

public String getSuit() {
	return this.suit;
}
/////////////////////////////////////////////////////////////////////////////////////////
/*method to get the value as a String
 * @return String
 */
public String getRank() {
	return this.rank;
}
//////////////////////////////////////////////////////////////////////////////////////////
/*method to get the index of the suit in the array
 * @return integer
 */
public int getIndexSuit() {
	return this.suitIndex;
}
///////////////////////////////////////////////////////////////////////////////////////////
/*method to get the index of the value in the array
 * @return integer
 */
public int getIndexRank() {
	return  this.rankIndex;
}
/////////////////////////////////////////////////////////////////////////////////////////////
/*method to get the String of the card
 * @ return String
 */
public String toString() {
	return this.rank + this.suit;
}
////////////////////////////////////////////////////////////////////////////////////////////
//method to print the String of the value and suit of the card
public void displayCard() {
	System.out.println(toString());
}
///////////////////////////////////////////////////////////////////////////////////////////

}
