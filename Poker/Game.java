package Pokerfx;
import java.util.InputMismatchException;


import javax.swing.JOptionPane;

//a game class that deals with the rules of the different stages of a poker game such as opening, refresh etc.
public class Game {
	private  Player player;
	private Dealer dealer;
	private  Deck poker;
	private int pot;
	private int round;
/////////////////////////////////////////////////////////////////////////////////////////////////////	
public Game(){
	//pot starts at 0
	pot = 0;
	round = 2;//set to one as GUI with deal first round
	//create a deck object and shuffle it
	this.poker= new Deck();
	poker.shuffleDeck();
	//intialising the members with hands from the shuffled deck for the game
	
	Hand hand = new Hand(poker);
	Hand hand2 = new Hand(poker);
	
	//initialise the GameMembers with their hands and tokens.
	dealer = new Dealer(hand, 10);
	player = new Player(hand2,10);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
public void displayDeck() {
	poker.displayDeck();
}
/////////////////////////////////////////////////////////////////////////////////////


// used to start a new round while keeping the same players so that the number of tokens carries over.
public void newHand() {

	Hand hand = new Hand(poker);
	Hand hand2 = new Hand(poker);
	dealer.setHand(hand);
	player.setHand(hand2);
}
////////////////////////////////////////////////////////////////////////////////
	public void displayHands() {
		System.out.printf("Dealer's hand: %n%s%n", dealer.getHand());
		System.out.printf("Player's hand: %n%s%n", player.getHand());
	}

//////////////////////////////////////////////////////////////////
	public void displayDealerHand() {
		System.out.printf("Dealer's Hand is: %n%s%n ", dealer.getHand());
	}
///////////////////////////////////////////////////////////////////////////	
	public Hand getDealerHand() {
		return dealer.getHand();
	}
	

///////////////////////////////////////////////////////////////////////////////
	public void displayPlayHand() {
		System.out.printf("Player's Hand is: %n%s%n ", player.getHand());
	}
////////////////////////////////////////////////////////////////////////	
	public Hand getPlayHand() {
		return player.getHand();
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////
	/*a method that users an array of the players choice of cards to refresh.  
	This array is then used in the players, refresh method.*/
	public void refresh(int[] i) {
		player.refresh(i);

	}

//////////////////////////////////////////////////////////////////////////////////////////////////	
	/* a method that refreshes the dealer's hand. The dealers method put there choice of cards into an array
	 * This method checks that array and uses it to refresh the dealer's cards.
	 */
	public void dealerRefresh() {
		/*even if the dealer chooses to refresh all 5 cards based on its'logic' it can only refresh 4 
		 * so the last card is automatically set to false
		 */
		//displayDealerHand();
	
		int count = 0;
		for (int i = 0; i < 5; i++) {
			if (dealer.refresh()[i] == true) {
				count++;
			}
				if (count == 5) {
					count--;
				}
			}
		
		//create a new int array that can be used with parent method
		int[] cardRefresh = new int[count];
		int k = 0; int j = 0;
		
		while(k < 4 && k < count) {
		
			if (dealer.refresh()[j] == true) {
				cardRefresh[k] = j;
				k++;
				System.out.println("Dealer will refresh card:" + (j));
				}
			    j++;
				}
			
			
		
		// refresh the dealer's chosen cards
		dealer.refresh(cardRefresh);
		displayDealerHand();
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////
	/*A method that takes the users input to decide if 
	 * the game will open and returns a boolean
	 * @return boolean
	 */
	public boolean opening(String open)throws IllegalArgumentException{
		if(!(open.equalsIgnoreCase("yes")|| open.equalsIgnoreCase("no"))) {
			throw new IllegalArgumentException("You must enter yes or no");
		}
		boolean opens = false;
	
		
		//if the player chooses yes the game is opens and each player put 1 token int the pot
		if (open.equalsIgnoreCase("yes")) {
			//if the player wants to but can't open.
			if(player.getHand().twoJacks()==false && player.getRank()<2) {
				JOptionPane.showMessageDialog(null, "You must have two jacks or higher");
				boolean dealeropen = dealer.open();
				//if the players wants to but can't open and dealer can't open
				if(dealeropen == false) {//if neither want to open a new round is started

					JOptionPane.showMessageDialog(null, "Neither does the computer, let's start a new round.");
					opens = false;
					
				}//if the player wanted to open but can;t and dealer can.
				else if(dealeropen==true) {
					player.bet(1);
					opens = true;
					pot=pot +2;
					
				}
				
				}
			//if the player wants to and can.
		else {
			player.bet(1);
			dealer.bet(1);
			pot = pot + 2;//update pot
			opens = true;
		}
			//if the player says no then the dealer's method to decide whether to open is called
		} else if (open.equalsIgnoreCase("no")) {
			boolean dealeropen = dealer.open();
			//if the dealer wants to open the player must also put 1 token in the pot
			if (dealeropen == true) {
				player.bet(1);
				opens = true;
				pot = pot + 2;//update pot
			} else if (dealeropen == false) {//if neither want to open a new round is started

				JOptionPane.showMessageDialog(null, "Neither does the computer.Lets start a new round");
				opens = false;
				//newRound();
			
				

			}
		}
		
		
		
	return opens;

	}

////////////////////////////////////////////////////////////////////////////////////////////////////
	/*a method for the game to check who the winner is based on their hand.  If they both have similar hands then 
	*then best card is checked
	*@return String
	*/
	public String winner() {
		String winner;
		if (dealer.getRank() > player.getRank()) {
			winner = "computer";
			//System.out.println("best Card" + dealer.getBestCard() + "player" + player.getBestCard());

			if ((dealer.getRank() == player.getRank()) && (dealer.getBestCard() > player.getBestCard())) {
				winner = "computer";
				//System.out.println("best Card" + dealer.getBestCard() + "player" + player.getBestCard());
			}
			if ((dealer.getRank() == player.getRank()) && (player.getBestCard() > dealer.getBestCard())) {
				winner = "Player";
				//System.out.println("best Card" + dealer.getBestCard() + "player" + player.getBestCard());
			}
		} else {
			winner = "Player";
			//System.out.println("best Card" + dealer.getBestCard() + "player" + player.getBestCard());

		}
		return winner;

	}



///////////////////////////////////////////////////////////////////////////////////////////////////////
	/* method to get the dealer's tokens
	 * @return int tokens
	 */
	public int getDealerTokens() {
		return dealer.getTokens();
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////
	/* method to get the player's tokens
	 * @return int tokens
	 */
	public int getPlayerTokens() {

		return player.getTokens();
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////
	/* a method to decide if the players will see or fold after a bet is made, returns a boolean 
	 * return boolean
	 */
	public boolean see(int amount)throws IllegalArgumentException {
		if(amount<0 || amount>3) {
			throw new IllegalArgumentException("Your bet must be between 0 and 3");
		}
		
		boolean compsee = false;
		//check if the player has enough tokens for the bet
		if (player.see(amount) == false) {
			System.out.println("You don't have enough tokens");
			System.out.println("You only have: " + player.getTokens() + "Try again");
			compsee = false;
		}
		// if the player can see and the dealer doesn't want to. Player wins the pot.
		
		if (player.see(amount) == true && dealer.see(amount) == false) {
			JOptionPane.showMessageDialog(null, "The computer folds you win. Let's start a new round");
			player.win(pot);//player wins pot
			pot = 0;//reset pot
			
			
		}
//the player can bet and the players want to see them
		if (player.see(amount) == true && dealer.see(amount) == true) {
			JOptionPane.showMessageDialog(null, "The computer will see you");
			player.bet(amount);
			dealer.bet(amount);
			pot = pot + (amount * 2);//update pot
			compsee = true;
			//displayDealerHand();
			JOptionPane.showMessageDialog(null, "The winner of the round is:" + winner());
			winPot(winner());//winner announced
			System.out.println("Player's tokens" + player.getTokens());
			System.out.println("Dealer's tokens" + dealer.getTokens());
		}
		
		return compsee;
	}

///////////////////////////////////////////////////////////////////////////////////////////////////
	/*method to show content of pot
	 * @return int amount in the pot
	 */
	
	public int getPot() {
		return pot;
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////
	//method to give the pot to the winner
	public void winPot(String i) {

		if (i.equalsIgnoreCase("computer")) {
			dealer.win(pot);
		}
		if (i.equalsIgnoreCase("Player")) {
			player.win(pot);
		}
		pot = 0;//reset pot
	}
//////////////////////////////////////////////////////////////////////////////////////////////
	//Method to start the game and display the hands. Not needed with GUI.
	public void startGame() {
		JOptionPane.showMessageDialog(null, "Here is your hand");
		
		
		System.out.println("Dealer's token: " + getDealerTokens());
		System.out.println("Player's token: " + getPlayerTokens());
		System.out.println("The pot is: " + getPot());
		System.out.println();
		
		
	}
	///////////////////////////////////////////////////////////////////////////////////////////
	public void newRound() {
		JOptionPane.showMessageDialog(null, "Here is your hand");
		newHand();
		System.out.println("Round:" + round);
		//I display both hands so you can check funtionality though with a real game it would display only the player's
		displayDealerHand();
		displayPlayHand();
		System.out.println("Dealer's token: " + getDealerTokens());
		System.out.println("Player's token: " + getPlayerTokens());
		System.out.println("The pot is: " + getPot());	
		round++;
		System.out.println();
	}
	///////////////////////////////////////////////////////////////////////////////////////////////
	
	/*@ return String
	 * 
	 */
			public String toString() {
		String toString = "";
		toString = player.toString() + dealer.toString() + "Pot:"+ getPot();
		return toString;
	}
	////////////////////////////////////////////////////////////////////////////////////
}



