
//A hand class that creates and array of cards and uses a deck as a parameter to its constructor to draw the cards from

public class Hand {

	Card [] hand;
	
	////////////////////////////////////////////////////////////////////////////////////
//uses a deck as a parameter to its constructor to draw the cards from

	public Hand(Deck poker)
	{
		
		
		hand = new Card[5];
		
		//test for a straight
		/*hand[0]= new Card(0,9);
		hand[1]= new Card(0,10);
		hand[2] = new Card(0,11);
		hand[3] = new Card(0,12);
		hand[4] = new Card(0, 0);
		*/
		
		//test for a flush
		/*hand[0]= new Card(1,9);
		hand[1]= new Card(1,10);
		hand[2] = new Card(1,11);
		hand[3] = new Card(1,12);
		hand[4] = new Card(1, 0);
		*/
		 
		
		//using the drawTopCard method to initialize the array of cards.
		for(int i=0; i < 5; i++)
		{ 
			hand[i] = poker.drawTopCard();
				 
		}
	}


////////////////////////////////////////////////////////////////////////////////////////////////////////////
//method to display the cards in the hand
	public void displayHand() 
	{
		for(int i = 0; i<5; i++) 
		{
			hand[i].displayCard();
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	/*method that puts uses the indexes of the values of the cards
	*found in the hand to count into another array so they can be counted e.g aces go in index 0 of new array based on their index.
	*/
	public int [] checkHand() {
		
		int [] match= new int [13];
		     
		for(int i = 0; i <5 ; i++) 
		{
		++match[hand[i].getIndexValue()];
				}
				  
	      return match;
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////				
//method that uses searches the array created in checkHand() to look for pairs
	
public String checkPairs() {
	String result= null;
	int pair = 0;
	
	 for(int i = 0; i<13; i++) 
	 {
			if(checkHand()[i] == 2) 
			{
				pair++;
					if(pair == 1) 
					{
						result = "pair";
					}
					if(pair == 2) {
						result = "2pairs";
					}
			}   
	 }
	 
	return result;
}
	
//////////////////////////////////////////////////////////////////////////////////////////////////
//method that searches the array created in checkHand() to look for triplets
public String checkTriplets() {
	String result= null;

	 for(int i = 0; i < 13; i++) {
			
			if(checkHand()[i] >= 3) 
			{
				result = "Triplet";
			}
	 }
	return result;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
//method that checks the suit of each card in the hand to check for a flush
public String checkFlush() {
	String flush = "flush"; 
	for (int x = 0; x < 4 ; x++)
	
	      	{
	            if ( hand[x].getSuit() != hand[x+1].getSuit() ) {
	            	flush = null;
	            }
	        }
	
		return flush;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//method that checks searches the values in the new array to check for cards running consecutively(a straight)
public String checkStraight() {
	
	String straight = null;
	
	//check the first 9 to see if there are consecutive cards for a straight
	for (int i = 0; i <9; i++) 
	{
		if((checkHand()[i] == 1) && (checkHand()[i+1] == 1) && (checkHand()[i + 2] == 1) && (checkHand()[i +3]== 1) && (checkHand()[i+4] == 1)) 
		{
			straight = "straight";
			return straight;
		}
		// check for an "ace-high straight", where 10, jack, queen, king, ace is a straight.
		if((checkHand()[9] == 1) && (checkHand()[10]== 1) && (checkHand()[11]== 1) && checkHand()[12]== 1 && checkHand()[0]== 1) 
		{
			straight = "straight";
		}
		
	}

	
	return straight;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//a method to check and compare the final highest result of the hand

public String finalResult() {
	String finalResult = "null";
	
	if(checkPairs() == "pair" && checkFlush() == null) {
		finalResult = "Pair";
	}
	if(checkPairs() == "2pairs" && checkFlush() == null) {
		finalResult = "2 Pairs";
	}
	
	if(checkTriplets() != null && checkFlush() == null) {
		finalResult = "Triplets";
	}
	if(checkStraight() != null && checkFlush() == null) {
		finalResult= "Straight";
	}
	if(checkFlush() != null) {
		finalResult = "Flush";
	}
	
	
	return finalResult;	
		
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// a method to rank the result of the hand so it can be compared to another hand
	public int finalRank() {
		//put the result of the hand into a String
		String result = finalResult();
		//Initialize the rank
		int rank=0;
		
		switch(result) 
		{
		
			case "Pair": rank = 1;
			break;
			case "2 Pairs": rank = 2;
			break;
			case "Triplets": rank = 3;
			break;
			case "Straight": rank = 4;
			break;
			case "Flush": rank = 5;
			break;
			default: rank = 0;
		}
		
		return rank;
		
	}
//////////////////////////////////////////////////////////////////////////////////////////////////		
	}
