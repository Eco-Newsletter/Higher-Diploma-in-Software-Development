package Pokerfx;
// a general class that can be extended later to differentiate between 'human' player and the dealer 'computer'
public abstract class GameMember {
	// all members of the poker game need a hand and tokens
	protected Hand hand;
	protected int tokens;

//////////////////////////////////////////////////////////////
	//with this constructor a deck and hand are initialised when object is created and would only be applicable for that player
	//e.g. 
	public GameMember() {
		this.hand = new Hand();
		this.tokens = 10;

	}

//////////////////////////////////////////////////////////////////////////////////////////////////////
	//this constructor enables the players to get a hand dealt from a deck in a game, then another players can get
	//a hand from the same deck
	public GameMember(Hand hand, int tokens) {
		this.hand = hand;
		this.tokens = tokens;
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public void setHand(Hand hand) {
		this.hand = hand;
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////
	//@ return hand
	public Hand getHand() {
		return hand;
	}

//////////////////////////////////////////////////////////////////////////////////////////////////
	public void setTokens(int tokens) {
		this.tokens = tokens;
	}

////////////////////////////////////////////////////////////////////////////////////////////////////
	/*
	 * @return int represents their tokens
	 */
	public int getTokens() {
		return tokens;
	}

	//////////////////////////////////////////////////////////////////////////////////////////////
	/*
	 * @ return int that represent rank
	 */
	public int getRank() {
		return hand.finalRank();
	}

	//////////////////////////////////////////////////////////////////////////////////////////////
	//a method to allow the member to win a pot from a game
	public void win(int pot) {
		tokens += pot;
	}

/////////////////////////////////////////////////////////////////////////////////////////////
	/*
	 * @ return String
	 */
	public String toString() {
		return "Hand is" + hand + "tokens are" + tokens;
	}

	////////////////////////////////////////////////////////////////////////////////////////
	/*a method that gets best card from the player's hand
	 * @return integer
	 */
	public int getBestCard() {
		return hand.getBestCard();
	}

	///////////////////////////////////////////////////////////////////////////////////////
	/* @ method that allows the player to bet if they have enough tokens, returns in 1 if the bet is valid
	 * @return int
	 */
	public int bet(int amount) {
		int betValid = 1;
		tokens = tokens - amount;
		//if the player doesn't have enough tokens to cover the bet it is not allowed
		if (tokens < 0) {
			System.out.println("You don't have enough tokens");
			tokens = tokens + amount;
			betValid = 0;
		}
		return betValid;
	}

	/////////////////////////////////////////////////////////////////////////////////////////////
	

	/////////////////////////////////////////////////////////////////////////////////////////
//a method that allows the player to choose a card to change
	public void refresh(int[] card) {
		
		for (int j = 0; j < card.length; j++) {
			getHand().newCard(card[j]);
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////
	public abstract boolean see(int amount) ;
	
	}

 ///////////////////////////////////////////////////////////////////////////////////////
 

