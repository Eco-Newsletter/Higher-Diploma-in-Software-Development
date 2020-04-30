package Pokerfx;

import javafx.application.Application;
import javafx.geometry.*;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.stage.Stage;
/* Poker GUI class that creates a stage for the game with a scene to start the game, it has a border pane which
 * has 2 Hboxes and 2 Vboxes inside to display the pot, tokens and hands of the players and buttons to open or not.
 *  It accesses variables using get methods from the Play class and invokes Play's main method using 
 *  the console/swing for the rest of the game. I got the layout idea from p581 of Intro to Java Programming, by Y.D.Liang
 */

public class PokerGui extends Application {
//
	private int playerTokens;
	private int dealerTokens;
	private Hand playerHand;
	private Hand dealerHand;
	private int pot;
	private Play play;

	private Button open = new Button("Open");
	private Button noOpen = new Button("Don't Open");
	
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public PokerGui() {
		//constructor to initialize the fields by creating an object of Play class and then by accessing Play's get methods.
		play = new Play();
		this.playerTokens = play.getPlayerTokens();
		this.dealerTokens = play.getDealerTokens();
		this.playerHand = play.getPlayerHand();
		this.dealerHand = play.getDealerHand();
		this.pot = play.getPot();

	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	public static void main(String[] args) {
		launch(args);
	}
////////////////////////////////////////////////////////////////////////////////////////////////////
	@Override
	public void start(Stage start) throws Exception {
//create the components of the GUI for Layout
		BorderPane window = new BorderPane();
		HBox potDisplay = getHboxPot();
		VBox playerDisplay = getVboxPlayer();
		VBox dealerDisplay = getVboxDealer();
		HBox buttons = getHBoxButton();
		
//Adjust layout of the borderpane
		window.setTop(potDisplay);
		window.setLeft(playerDisplay);
		window.setRight(dealerDisplay);
		window.setBottom(buttons);
		
	//Put the Pane into the Scene
		Scene play = new Scene(window, 350, 350);
		
		//put the scene into the stage and give it a title
		start.setScene(play);
		start.setTitle("PokerGame");
		start.show();//display stage
		
//set the buttons in 'action' by assigning action event which here is the main method from object play. It passes the string 
//		to the main method which then passes it into the firstOpening() method of the Game class which is an object of Play.
		open.setOnAction(e -> Play.main("yes"));
		noOpen.setOnAction(e -> Play.main("No"));

	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//VBox to contain the player's hand and tokens on the left
	//this method is private. It is specific to this class and does not need to be accessed by other classes.
	private VBox getVboxPlayer() {
		//labels for the tokens and hand
		Label playertokens = new Label();
		playertokens.setText(String.format("Player's Tokens: %d", this.playerTokens));
		Label playerHand = new Label();
		playerHand.setText(String.format("Player's hand: %n %s", this.playerHand));
		//Create the Vbox
		VBox player = new VBox(30);
		player.setPadding(new Insets(15, 15, 15, 15));
		//Add the tokens and hand to the VBox
		player.getChildren().add(playertokens);
		player.getChildren().add(playerHand);
		return player;
	}
	///////////////////////////////////////////////////////////////////////////////////////////////
	//VBox to contain the dealer's tokens on the right
	//this method is private. It is specific to this class and does not need to be accessed by other classes.
	private VBox getVboxDealer() {
		//Create the labels
		Label dealertokens = new Label();
		dealertokens.setText(String.format("Dealer's Tokens: %d", this.dealerTokens));
		Label dealerHand = new Label();
		dealerHand.setText(String.format("Dealer's hand:%n %s", this.dealerHand));
		//Create the VBox
		VBox dealer = new VBox(30);
		dealer.setPadding(new Insets(15, 15, 15, 15));
		//Add the labels
		dealer.getChildren().add(dealertokens);
		dealer.getChildren().add(dealerHand);

		return dealer;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////

//Create a method to create the HBox for the pot at top
	//this method is private. It is specific to this class and does not need to be accessed by other classes.
	private HBox getHboxPot() {
		//Create the labels
		Label pot = new Label();
		pot.setText(String.format("Pot: %d", this.pot));
		//Create the box
		HBox potdisplay = new HBox();
		potdisplay.setPadding(new Insets(15, 15, 15, 15));
		potdisplay.setAlignment(Pos.BASELINE_CENTER);
		//Add the pot
		potdisplay.getChildren().add(pot);

		return potdisplay;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////
	//A method to create the Hbox for buttons at bottom
	//this method is private. It is specific to this class and does not need to be accessed by other classes.

	private HBox getHBoxButton() {
//Create box
		HBox button = new HBox(10);
		button.setPadding(new Insets(15, 15, 15, 15));
		button.setAlignment(Pos.BASELINE_CENTER);
		//Add the buttons
		button.getChildren().add(open);
		button.getChildren().add(noOpen);

		return button;

	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////

	}
	
	
	


