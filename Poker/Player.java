package Pokerfx;



/* player class that instantiates the abstract GameMember class*/
public class Player extends GameMember {
	
	public Player() {
	}
	

	public Player(Hand hand, int tokens) {
		super(hand, tokens);

	}

///////////////////////////////////////////////////////////////////////////////////////
	//public void displayHand() {
	//	getHand().displayHand();
	//}

///////////////////////////////////////////////////////////////////////////////////////
	/*a method to check if the player has enough tokens to see*/
	 public boolean see(int amount) {
	 
		boolean see = true;
		if (getTokens() < amount) {
			see = false;
		}

		else {
			see = true;
		}
		return see;
	}

//////////////////////////////////////////////////////////////////////////////////////

}
