package Pokerfx;
import javax.swing.JOptionPane;

//dealer extends from the member class
public class Dealer extends GameMember{
	
	/////////////////////////////////////////
	//uses the constructor that takes a hand and number of tokens
	public Dealer(Hand hand, int tokens) {
		super(hand, tokens);
		
		
	}
//////////////////////////////////////////////////////////////////////////////////////////
	/*a method to help the dealer decide to open if it has two jacks or higher
	 * @ return boolean that shows if computer will open or not
	 */
	
		public boolean open() {
			 boolean open = false;
			 if(getHand().twoJacks() == true || getHand().finalRank()>1)
			 {
				 setTokens(getTokens()-1);
				 open = true;
				 JOptionPane.showMessageDialog(null, "The computer wants to open");
				 
			  }else{ 
				  open = false;
	        }
			 return open;
		 }
	
		
/////////////////////////////////////////////////////////////////////////////////////////////
		/* a method that creates a boolean array with the dealers choice of cards to refresh
		 * @return boolean[] to store if a card is refreshed or not
		 */
		
		public boolean[] refresh() {
	

		boolean[] cardRefresh = new boolean[5];

		if (getHand().finalRank() >= 3) {
			for (int i = 0; i < 5; i++) {
				cardRefresh[i] = false;
			}
		} else {
			
			/*checking each card in the hand, if it is part of 3 consec, a
			 *  pair or more or 3 of same suit the comp DOES want to refresh it
			 */

			for (int i = 0; i < 5; i++) {				
				if (getHand().consecCardBottom(i) == false && getHand().consecTop(i) == false
						&& getHand().consecMid(i) == false && getHand().isPairOrMore(i) == false
						&& getHand().isSameSuit(i) == false) {
					cardRefresh[i] = true;
				}
			}
		}
		return cardRefresh;  //the array of the cards the comp wants to refresh
	}
///////////////////////////////////////////////////////////////////////////////////////////////
	// a method to decide if it would see.  if it has enough tokens and 2 pairs or more
		public boolean see(int amount) throws IllegalArgumentException {
			if(amount<0) {
				throw new IllegalArgumentException("Bet cannot be negative");
			}
		boolean see = true;
		
		if( getTokens()< amount) {
			see = false;
		}
		if(getRank()< 2) {
			see = false;
		}
			
		return see;
	}
		
		
	}


/////////////////////////////////////////////////////////////////////////////////////////////////

