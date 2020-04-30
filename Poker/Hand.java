package Pokerfx;
//A hand class that creates and array of cards and uses a deck as a parameter to its constructor to draw the cards from

public class Hand {
	Deck deck;// had to add the deck here to be able to use its methods in hand methods
	Card[] hand;
	int bestCard;//used to decide the best card in a hand in case 2 players have same hand

	////////////////////////////////////////////////////////////////////////////////////
//uses a deck as a parameter to its constructor to draw the cards from
	public Hand() {
		this.deck = new Deck();
		hand = new Card[5];
		
		for (int i = 0; i < 5; i++) {
			this.hand[i] = this.deck.drawTopCard();

		}

	}

///////////////////////////////////////////////////////////////////////////////////////////
	public Hand(Deck deck) {

		this.deck = deck;
		hand = new Card[5];

		//test for a straight
				/*hand[0]= new Card(0,9);
				hand[1]= new Card(0,10);
				hand[2] = new Card(0,5);
				hand[3] = new Card(0,1);
				hand[4] = new Card(0, 9);
				*/
				
				//test for a flush
				/*hand[0]= new Card(1,1);
				hand[1]= new Card(2,1);
				hand[2] = new Card(2,1);
				hand[3] = new Card(0,7);
				hand[4] = new Card(3, 11);*/
				
				
				//using the drawTopCard method to initialize the array of cards.
				for(int i=0; i < 5; i++)
				{ 
					hand[i] =deck.drawTopCard();
						 
				}
			}

////////////////////////////////////////////////////////////////////////////////////////////////////////////
//method to display the cards in the hand
	public void displayHand() {
		for (int i = 0; i < 5; i++) {
			hand[i].displayCard();
		}
	}

//////////////////////////////////////////////////////////////////////////////////////////////////
	//a method to allow a new deck
	public void setDeck(Deck deck) {
		this.deck = deck;
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////	
	public Deck getDeck() {
		return this.deck;
	}
	//////////////////////////////////////////////////////////////////////////////////////////////
	//a method to give a change a card for the player
	public void newCard(int i) {
		hand[i] = deck.drawTopCard();

	}

///////////////////////////////////////////////////////////////////////////////////////////////	
	@Override
	public String toString() {
		String showHand = "";

		for (int i = 0; i < 5; i++) {
			showHand = showHand + (hand[i].toString() + "\n");

		}
		return showHand;
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////
	public int getBestCard() {
		return bestCard;
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	/*
	 * method that puts uses the indexes of the values of the cards found in the
	 * hand to count into another array so they can be counted e.g aces go in index
	 * 0 of new array based on their index.
	 */
	public int[] checkHand() {

		int[] match = new int[13];

		for (int i = 0; i < 5; i++) {
			++match[hand[i].getIndexRank()];
		}

		return match;
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////				
//method that uses searches the array created in checkHand() to look for pairs

	public String checkPairs() {
		String result = null;
		int pair = 0;
		int max = 0;

		for (int i = 0; i < 13; i++) {
			if (checkHand()[i] == 2) {
				pair++;
				if (i > max) {
					max = i;
					bestCard = max;
				}
				if (pair == 1) {
					result = "pair";

				}
				if (pair == 2) {
					result = "2pairs";

				}
			}
		}

		return result;
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////
	// a method that check is a card is part of a pair
	public boolean isPairOrMore(int card) {
		
		

		boolean isPair = false;
		for (int i = 0; i < 13; i++) {
			if (checkHand()[i] >= 2 && i == hand[card].getIndexRank()) {
				isPair = true;
				bestCard = i;//save the rank of the pair
			}
		}
		return isPair;
	}

////////////////////////////////////////////////////////////////////////////////////////////
//check if there are 2 jack on the hand
	public boolean twoJacks() {
		boolean open = false;
		if (checkHand()[10] == 2 || checkHand()[11]==2 || checkHand()[12]== 2) {//if the count in index 10 is 2 there are 2 jacks
			open = true;
		}
		return open;
	}

//////////////////////////////////////////////////////////////////////////////////////////////////
//method that searches the array created in checkHand() to look for triplets
	public String checkTriplets() {
		String result = null;

		for (int i = 0; i < 13; i++) {

			if (checkHand()[i] == 3) {
				result = "Triplet";
				bestCard = i;
			}
		}
		return result;
	}

//////////////////////////////////////////////////////////////////////////////////////
	
	// a method to check for 4 in a row
	public String checkFour() {
		String result = null;

		for (int i = 0; i < 13; i++) {

			if (checkHand()[i] == 4) {
				result = "Fourkind";
				bestCard = i;
			}
		}
		return result;
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////
	/*method that put the counts the cards that have same suit and puts into an array
	 * @ return int []
	 */
	public int[] sameSuits() {
		int sameSuit[] = new int[4];

		for (int i = 0; i < 5; i++) {
			++sameSuit[hand[i].getIndexSuit()];
		}

		return sameSuit;

	}

///////////////////////////////////////////////////////////////////////////////////////////////////////
	/*method that check the array of cards of the same suit against the 
	index of card in the deck, to identify which cards are part of same suit 
	@ return boolean 
	@param integer representing the index of the card in the hand*/
	public boolean isSameSuit(int card) {
		boolean sameSuit = false;
		for (int j = 0; j < 4; j++) {
			if (sameSuits()[j] >= 3 && j == hand[card].getIndexSuit()) {
				sameSuit = true;
			}
		}
		return sameSuit;
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////
	//method to check for a flush, returns a string
	public String checkFlush() {
		String flush = "flush";
		int max = hand[0].getIndexRank();
		for (int x = 0; x < 4; x++) {
			if (hand[x].getSuit() != hand[x + 1].getSuit()) {//loop through hand to find if 4 cards of same suits
				flush = null;
			}

			else {
				for (int i = 1; i < 5; i++) {
					if (hand[i].getIndexRank() > max) {//loop through to check the highest ranked card of the flush
						max = (hand[i].getIndexRank());
						bestCard = max;
					}
				}
			}
		}
		return flush;
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////
	/*boolean method that decides is a card in the hand is the lowest (in index) of consecutive cards
	 * @ return boolean
	 * @param integer representing the index of the card in the hand
	 */
	public boolean consecCardBottom(int card) {
		int[] hands = new int[13];
		for (int i = 0; i < 13; i++) {
			hands[i] = checkHand()[i];
		}
		boolean consecutive = false;
		for (int i = 0; i < 11; i++) {
			if ((hands[i] >= 1) && (hands[i + 1] >= 1) && (hands[i + 2] >= 1) && (i == hand[card].getIndexRank())) {
				consecutive = true;
			}

		}
		return consecutive;
	}

////////////////////////////////////////////////////////////////////////////////////////////////////
	/*boolean method that checks if the card if top (index) of consec cards
	 * @return boolean
	 * @param integer representing the index of the card in the hand
	 */
	public boolean consecTop(int card) {
		int[] hands = new int[13];
		for (int j = 0; j < 13; j++) {
			hands[j] = checkHand()[j];
		}
		boolean consec = false;
		for (int k = 12; k > 1; k--) {
			if ((hands[k] >= 1) && (hands[k - 1] >= 1) && (hands[k - 2] >= 1) && (k == hand[card].getIndexRank())) {
				consec = true;
			}
		}

		return consec;
	}

	//////////////////////////////////////////////////////////////////////////////////
	
	//method to check if a card id mid consec card
	public boolean consecMid(int card) {
		int[] hands = new int[13];
		for (int k = 0; k < 13; k++) {
			hands[k] = checkHand()[k];
		}
		boolean consec = false;
		for (int i = 1; i < 12; i++) {
			if ((hands[i] >= 1) && (hands[i - 1] >= 1) && (hands[i + 1] >= 1) && (i == hand[card].getIndexRank())) {
				consec = true;
			}
		}
		return consec;
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////
//method that checks searches the values in the new array to check for cards running consecutively(a straight)
	/* @ return String*/
	public String checkStraight() {

		String straight = null;

		// check the first 9 to see if there are consecutive cards for a straight
		for (int i = 0; i < 9; i++) {
			if ((checkHand()[i] == 1) && (checkHand()[i + 1] == 1) && (checkHand()[i + 2] == 1)
					&& (checkHand()[i + 3] == 1) && (checkHand()[i + 4] == 1)) {
				straight = "straight";
				bestCard = i + 4;

			}
			// check for an "ace-high straight", where 10, jack, queen, king, ace is a
			// straight.
			if ((checkHand()[9] == 1) && (checkHand()[10] == 1) && (checkHand()[11] == 1) && checkHand()[12] == 1
					&& checkHand()[0] == 1) {
				straight = "highstraight";

			}
		}
		return straight;
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
	/* @ return String*/
	public String fullHouse() {
		String house = null;
		if (checkTriplets() != null && checkPairs() == ("pair")) {//full house have a triplet and pair
			house = "fullhouse";
		}
		return house;
	}

////////////////////////////////////////////////////////////////////////////////////////////////
	/* @ return String*/
	public String royalFlush() {
		String royal = null;
		if (((checkStraight()) == ("highstraight")) && (checkFlush() != null)) {//royal flush has a highstraight and a flush
			royal = "royalflush";

		}
		return royal;
	}

//////////////////////////////////////////////////////////////////////////////////////////////////
	/* @ return String*/
	public String straightFlush() {
		String royal = null;
		if (checkStraight() == ("straight") && checkFlush() != null) {//straight flush has a flush and straight
			royal = "straightflush";
		}
		return royal;
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	// a method to check and compare the final highest result of the hand
		/* @ return String*/

	public String finalResult() {
		String finalResult = "null";

		if (checkPairs() == "pair" && checkFlush() == null) {
			finalResult = "Pair";
		}
		if (checkPairs() == "2pairs" && checkFlush() == null) {
			finalResult = "2 Pairs";
		}

		if (checkTriplets() != null && checkFlush() == null) {
			finalResult = "Triplets";
		}
		if (fullHouse() != null) {
			finalResult = "fullhouse";
		}
		if (checkStraight() != null && checkFlush() == null) {
			finalResult = "Straight";
		}

		if (checkFlush() != null && checkFour() == null && straightFlush() == null && royalFlush() == null) {
			finalResult = "Flush";
		}
		if (checkFour() != null && checkFlush() == null) {
			finalResult = "FourKind";
		}

		if (straightFlush() != null && royalFlush() == null) {
			finalResult = "straightflush";
		}
		if (royalFlush() != null) {
			finalResult = "royalflush";
		}

		return finalResult;

	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/*a method to rank the result of the hand so it can be compared to another hand
	* @ return integer
	 * */
	public int finalRank() {
		// put the result of the hand into a String
		String result = finalResult();
		// Initialize the rank
		int rank = 0;

		switch (result) {

		case "Pair":
			rank = 1;
			break;
		case "2 Pairs":
			rank = 2;
			break;
		case "Triplets":
			rank = 3;
			break;
		case "fullhouse":
			rank = 4;
			break;
		case "Straight":
			rank = 5;
			break;
		case "Flush":
			rank = 6;
			break;
		case "FourKind":
			rank = 7;
			break;
		case "straightflush":
			rank = 8;
			break;
		case "royalflush":
			rank = 9;
			break;
		default:
			rank = 0;
		}

		return rank;

	}

//////////////////////////////////////////////////////////////////////////////////////////////////	
	
}





