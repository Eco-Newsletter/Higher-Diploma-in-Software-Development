package Pokerfx;

import java.util.Scanner;
import javax.swing.JOptionPane;

//Game class that deals 2 hands from one deck
public class Play {
	private static Game poker = new Game();

	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// Method to get Player Hand for use by the GUI
	public  Hand getPlayerHand() {
		return poker.getPlayHand();
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////
	// Method to get Dealer Hand for use by the GUI
	public  Hand getDealerHand() {
		return poker.getDealerHand();
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////
	// Method to get Player tokens for use by the GUI
	public int getPlayerTokens() {
		return poker.getPlayerTokens();
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Method to get Dealer Tokens for use by the GUI
	public  int getDealerTokens() {
		return poker.getDealerTokens();
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// Method to get Pot for use by the GUI

	public int getPot() {
		return poker.getPot();
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	//method to open the game the first time when the hands are already intitialised when game object was 'created'.
	public static void firstopening(String opening) {

		// if the game opens they proceed to refresh()
		boolean open = poker.opening(opening);
		if (open == true) {

		}
		if (open == false) {
			// if the player and computer do not wish to open then it moves to nextOpening()
			// which will deal a new hand for both
			nextOpening();

		}

	}
		//////////////////////////////////////////////////////////////////////////////////////////////////////
	/*a method that invokes the Game classes newRound() method to deal a new hand and display those hands
	 * it them invokes the Game classes opening(String) method and uses the user input	
	 */
	
	public static void nextOpening() {
		
			boolean play = true;
			
			//while loop so the player keep being asked to start a new round if they both cannot open
			while (play == true) {
				poker.newRound();

				
				do {//a do while set up for the try catch to check for correct user input.  If the user input is invalid it asks again
					try {//try catch for valid input catches illegal argument exception

						String reply2 = JOptionPane.showInputDialog(null, "Would you like to open the round?");
						boolean open = poker.opening(reply2);
						if (open == true) {
							play = false;
							break;//break out of try catch if valid input
						}
						if (open == false) {
							break;//break out of try catch if valid input
						}

					} catch (IllegalArgumentException ex) {
						JOptionPane.showMessageDialog(null, ex);
					}
				} while (play == true);

			}
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	/*
	 * this section of the driver takes the input for the refresh part of the game.  It tales the user input and performs several check.
	 */
	public static void refresh() {
		int tries = 4;
		int totalcards;
		while (--tries > 0) {
			try {// a try catch to check for numeric input
				do {//check the user doesn't choose more than 4 cards to refresh
					totalcards = Integer.parseInt(
							JOptionPane.showInputDialog(null, "How many cards would you like to change up to four?"));
					if (totalcards > 4 || totalcards < 0) {
						JOptionPane.showMessageDialog(null, "Enter a number between 0-4");
					}

				} while (totalcards > 4 || totalcards < 0);

				int input = 0;
				int[] cards = new int[totalcards];
				boolean duplicate = false;
				do {//check that the user chooses cards in range
					for (int i = 0; i < totalcards; i++) {
						do {
							input = (Integer
									.parseInt(JOptionPane.showInputDialog(null, "Enter the number of card:" + (i + 1))))
									- 1;
							if (input > 4 || input < 0) {
								JOptionPane.showMessageDialog(null, "Enter a number between 1-5");
							}

						} while (input > 4 || input < 0);

						cards[i] = input;//an array of the users choice of cards to refresh
					}

					int k = 0;//check the array to see if there is any duplicate input e.g. card 1 more than once.
					int count = 0;
					while (k < cards.length) {
						for (int j = k + 1; j < cards.length; j++) {
							if (cards[k] == cards[j]) {
								count++;
							}
						}
						k++;
					}
					if (count == 0) {
						duplicate = false;

					} else {
						duplicate = true;
						JOptionPane.showMessageDialog(null, "You entered the same number more than once. Try again" + duplicate);
					}

				} while (duplicate == true);

				// refresh the cards and check new hands
				poker.refresh(cards);
				poker.dealerRefresh();
				poker.displayPlayHand();
				break;
			} catch (IllegalArgumentException e) {
				JOptionPane.showMessageDialog(null, "Non numeric input: Enter a number");
			}
		}
	}

	/////////////////////////////////////////////////////////////////////////////
	//A method that takes input from the user about the bet they will place and then call the game's methid to chech if the 
	//dealer would like to see and declares a winner.
	public static void bet() {
		int attempts = 4;
		while (--attempts != 0) {
			//try catch to check number are in range
			try {
				int betAmount = 0;

				betAmount = Integer.parseInt(JOptionPane.showInputDialog("How much would you like to bet (0-3)?"));
				boolean bet= poker.see(betAmount);
				if (bet == false|| bet == true) {
					
				break;
				}
				
			} catch (IllegalArgumentException ex) {
				System.out.println(ex);
			} 

		} 
		
	}

	// the player can then fold or continue with the game but first the do-while
	// only lets both players proceed to the
	// next round if they have 1 or more tokens, otherwise the game ends and the
	// player with the most tokens wins..
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
	//a method to take input from user and check if they want to play another round
	public static boolean newround() {
		String newRound = null;
		boolean play = true;
		do {
			newRound = JOptionPane.showInputDialog(null, "Would you like to start a new Round?");
			if (newRound.equalsIgnoreCase("yes")) {
				break;
			}

			if (newRound.equalsIgnoreCase("No")) {
				play = false;
				break;
			} else {
				JOptionPane.showMessageDialog(null, "Please enter yes or no");

			}
		} while (play == true);
		return play;
		
		}

	 // round continue if the player wants to and
		// if both have enough tokens
		// at the end of the game the player with the most tokens wins.
	//////////////////////////////////////////////////////////////////////////////////////////////////////
//a method to end the game and decide who is the winner
	public static void endgame() {
		poker.displayHands();

		JOptionPane.showMessageDialog(null, "Player has " + poker.getPlayerTokens() + " and " + "Dealer has " + poker.getDealerTokens());
		if (poker.getPlayerTokens() < poker.getDealerTokens()) {
			JOptionPane.showMessageDialog(null, "Dealer wins the game");
		} else {
			JOptionPane.showMessageDialog(null, "Player wins the game");
		}
		JOptionPane.showMessageDialog(null, "Sorry Game Over!");
	

	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//main method to run the program
	public static void main (String reply) {
		Scanner scan = new Scanner(System.in);

		boolean firstgame = true;
		poker.displayHands();
		do {
			if(firstgame == true) {
		
			firstopening(reply);
		
			}
			else if (firstgame == false) {
				
				nextOpening();
				
			}
			refresh();
			bet();
			firstgame = false;
			boolean newround = newround();
			if(newround==false) {
				break;
			}
			else if (newround ==true) {
				firstgame = false;
				
			}
			
		} while (poker.getPlayerTokens() > 0 && poker.getDealerTokens() > 0);
		endgame();
	}
}
////////////////////////////////////////////////////////////////////////////////////////	
	









