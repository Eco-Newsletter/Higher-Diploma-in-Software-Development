/* A class to represent a deck of cards. 
 * Michelle
 * 10/3/20
 */
import java.util.Random;
public class Deck {

// create an array of card objects and a top card to keep track of which card has been drawn
private Card[] pack;
private int topCard;

/////////////////////////////////////////////////////////////////////////////////////////////////
public Deck() {
	
	this.pack = new Card[52];
    this.topCard = 51;
    int counterNumber = 0;
    
    // Filling the pack of cards with a card of each value and suit
    
	for(int suit = 0; suit < 4; suit++) 
	{
		for(int value = 0; value < 13; value++)
		{
		    this.pack[counterNumber]= new Card(suit,value);
		    counterNumber++;
		}   
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////
	
/*method to display all the cards in the deck
 * it uses the getValue and getSuit method from card class
 */
	public void displayDeck() {
		for(int i = 0; i < 52; i++)
		{
			System.out.println(this.pack[i].getValue()+ this.pack[i].getSuit());
		}
	}

/////////////////////////////////////////////////////////////////////////////////////
/* a method to shuffle the card by creating a temp card, using a random generator to
 * then exchange the values of each card
 */
	
	public void shuffleDeck() {
	Random shuffle = new Random();
	Card temp = new Card(0,0);
	int x;
	for(int i=0 ; i <52; i ++)
	{
		x = shuffle.nextInt(52);
		temp = this.pack[i];
		this.pack[i]= this.pack[x];
		this.pack[x]= temp;
	}
	
}
///////////////////////////////////////////////////////////////////////////////////////
/* A method that ensures that a card is always drawn from the top of the pack
 *it shuffles and resets the top card once all the cards have been drawn
 */
	public Card drawTopCard() {
	
	Card drawCard = null;
	if (topCard > 0 ) {
	drawCard = this.pack[topCard];
	topCard--;
	}
	if (topCard == 0) {
		drawCard = this.pack[topCard];
		shuffleDeck();
		topCard = 51;
	}
	
	
	return drawCard;
}
/////////////////////////////////////////////////////////////////////////////////////////
}






