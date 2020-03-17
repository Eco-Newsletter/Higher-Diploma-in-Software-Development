//Game class that deals 2 hands from one deck
public class Game {
	public static void main(String[] args)
	{
		//create a deck
		Deck poker = new Deck();
		
		//test to see if the deck is correct
		//poker.displayDeck();
		
		//shuffle the deck
		poker.shuffleDeck();
		
		
		//test to see if the deck is shuffles and if the top card picks from index 51 down.
		//poker.displayDeck();
		System.out.println("GAMES STARTS NOW");
		
		//deal a hand from poker deck and display
		System.out.println("Player 1's hand:");
		Hand player1 = new Hand(poker);
		player1.displayHand();
		System.out.println();
		
		//test for a flush
		//System.out.println(player1.checkFlush());
		
		
		
		//test to see if it prints correct result
		//System.out.println("You have :");
		//System.out.println(player1.finalResult());
		//System.out.println();
		
		//deal another hand from the poker deck and display
		System.out.println("Player 2's hand:");
		Hand player2 = new Hand(poker);
		player2.displayHand();
		System.out.println();
		
		//test to see if it prints correct result
		//System.out.println("You have :");
		//System.out.println(player2.finalResult());
	
		//decide which hand wins by comparing the final rank of each
		
		if((player1.finalRank()) > (player2.finalRank()))
		{
			System.out.println("Player 1 wins");
		}
		else if(player1.finalRank() == player2.finalRank())
		{
			System.out.println("It is a draw");
		}else 
		{
			System.out.println("Player 2 wins");
		}
		}
	}