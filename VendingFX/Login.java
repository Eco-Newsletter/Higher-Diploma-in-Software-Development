package Vendingfx;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.util.HashMap;
import java.util.Map;

import javafx.application.Application;
import javafx.geometry.*;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;
import javafx.scene.text.Text;
import javafx.scene.text.TextAlignment;
import javafx.stage.Stage;

public class Login extends Application{
	
	//Create an object of vending machine to get al the logic from.
	private VM vendingmachine = new VM("src/Vendingfx/Clients.csv","src/Vendingfx/Admin.csv", "src/Vendingfx/ProductList.csv");
	
	//Class wide fields that will be used in several methods.
	private TextField tfUsername = new TextField();
	private PasswordField tfPassword = new PasswordField();
	private TextField enterLocation;
	private TextField tfName = new TextField();
	private TextField tfLocation = new TextField();
	private TextField tfPrice = new TextField();
	private TextField tfQuantity = new TextField();
	
	private String username, location;
	private String password;
	private Stage window;
	private int userDataIndex;
	private Scene userMenuScene, login;
	private BorderPane loginPane, userMenuPane;
	private VBox loginFields, locations, rightside;
	private Map<String, Button> buttons = new HashMap<String, Button>();
	private HBox title;
	private String reloadMessage;
	private Label messageBox = new Label();

	
	
	
	

	
	public static void main(String[] args) {
		launch(args);
	}
////////////////////////////////////////////////////////////////////////////////////////////////////
	@Override
	public void start(Stage PrimaryStage) throws Exception {
		//Main window and read in the files for later use in program.
		window = PrimaryStage;
		vendingmachine.readUsers();
		vendingmachine.readProducts();
		//button for action events
		buttons.put("loginButton", new Button("Login"));
		buttons.put("buy", new Button("Buy product"));
		buttons.put("logout", new Button("Logout"));
		buttons.put("addProducts", new Button("Add Products"));
		buttons.put("shutdown", new Button("Shut Down"));
		//create a login pane that will contain the vboxs and hboxes
		loginPane = new BorderPane();
		loginFields = getLoginFields();
		loginPane.setCenter(loginFields);//set the Vbox of login fields centre in borderpane
		String style = "-fx-background-color: rgba(100, 255, 255, 0.5);";
		loginPane.setStyle(style);
		loginPane.setBackground(Background.EMPTY);
		//set loginpane inside the scene
		login = new Scene(loginPane, 350, 350);
		login.setFill(Color.TRANSPARENT);
		//set the scene in the stage
		window.setScene(login);
		window.setTitle("Vending Login");
		window.show();

	//********************BUTTONS***********************************************//
	
		buttons.get("loginButton").setOnAction(e -> login());
		buttons.get("buy").setOnAction(e -> {
			try {
				buy();
			} catch (PurchaseException e1) {
				System.out.print("Insufficient funds");
				e1.printStackTrace();
			} catch (FileNotFoundException e1) {
				System.out.print("File not found");
				e1.printStackTrace();
			}
		});
		buttons.get("logout").setOnAction(e -> logout());
		buttons.get("addProducts").setOnAction(e -> reload());
		buttons.get("shutdown").setOnAction(e -> shutdown());

	}
	

	////////////////////////////////////////////////////////////////////////////////////////////////
	//a method that returns the login fields that will go in the Border Pane to create the scene for login box.
	//@return Vbox
	public VBox getLoginFields() {
		
		Label welcome = new Label();
		welcome.setText("Welcome to the Vending Machine.");
		welcome.setFont(new Font("Arial", 18));
		
		Label welcomecont = new Label();
		welcomecont.setText("Please Login");
		welcomecont.setFont(new Font("Arial", 18));
		
		Label username = new Label();
		username.setText("Username");
		
		Label password = new Label();
		password.setText("Password");
		
		VBox login = new VBox(20);
		login.setPadding(new Insets(10,10,10,10));
		String style = "-fx-background-color: rgba(100, 100, 255, 10);";
		login.setStyle(style);
		//add labels, textfields and button into the VBox
		login.getChildren().add(welcome);
		login.getChildren().add(welcomecont);
		login.getChildren().add(username);
		login.getChildren().add(tfUsername);
		login.getChildren().add(password);
		login.getChildren().add(tfPassword);
		login.getChildren().add(buttons.get("loginButton"));



		return login;
		
	}
	///////////////////////////////////////////////////////////////////////////////////////////////
	
	//******************************LOGIN*******************************
	
	public void login() {
		//Get variables of username and login from the textFields
		username = tfUsername.getText();
		password = tfPassword.getText();
		//store return value of user index to identify the user account.
		try {
			userDataIndex = vendingmachine.login(username, password);
		} catch (FileNotFoundException e) {
			System.out.print("No file found");

		}//Check if valid user input
		if (userDataIndex == -1) {
			System.out.print("Invalid Password");
			tfUsername.clear();
			tfPassword.clear();
			//if input is valid, use the index and get the user data including type.
		} else {
			String type = vendingmachine.getUserType(userDataIndex);//if user is a client

			if (type.equalsIgnoreCase("client")) {
			//Create the rightside of the menu for the user.
				getClientMenu();
				try {
					getProducts();
				} catch (FileNotFoundException e) {
					System.out.print("File not Found");
					e.printStackTrace();
				}
			} else { //if user is admin
				getAdminMenu();
			}
		}
			
		
	}
	


	///////////////////////////////////////////////////////////////////////////////////////////////
	// a method that creates the  rightside layout of the client menu
	//@return VBox
	
	public VBox getClientMenu() {
		rightside = new VBox(10);
		
		Label credit = new Label();
		credit.setText(String.format("Your balance is:  €%.2f", vendingmachine.getUserCredit(userDataIndex)));
		credit.setFont(new Font("Arial", 16));
		
		Label location = new Label();
		location.setText("Enter the location:");
		location.setFont(new Font("Arial", 16));
		//class wide field that is used to identify location of products in buy method
		enterLocation = new TextField();
		enterLocation.setMaxWidth(80);
		
		Label logout = new Label();
		logout.setText("Would you like to logout?");
		//put components into vbox
		rightside.getChildren().addAll(credit, location, enterLocation, (buttons.get("buy")), (buttons.get("logout")));
		return rightside;
	}
	// *****************************GETUSERMENU**********************************************

	public void getProducts() throws FileNotFoundException {

		///////////////////////////////////////////////////////////////////////////////////////////////////
		//create a hbox for row 1 of products in machine
		HBox row1 = new HBox(10);
		//labels for location a1
		Label a1 = new Label();
		a1.setText(String.format("       A1%n%s, €%.2f, %d", this.vendingmachine.getProductName(0),
				this.vendingmachine.getProductPrice(0),
				this.vendingmachine.getProductCount(0)));
		a1.setTextAlignment(TextAlignment.CENTER);
		a1.setFont(new Font("Arial", 12));
		//label for location b1
		Label b1 = new Label();
		b1.setText(String.format("       B1%n%s, €%.2f, %d", this.vendingmachine.getProductName(5),
				this.vendingmachine.getProductPrice(5), this.vendingmachine.getProductCount(5)));
		b1.setTextAlignment(TextAlignment.CENTER);
		b1.setFont(new Font("Arial", 12));
		//label for location c1
		Label c1 = new Label();
		c1.setText(String.format("       C1%n%s,€ %.2f, %d", this.vendingmachine.getProductName(10),
				this.vendingmachine.getProductPrice(10), this.vendingmachine.getProductCount(10)));
		c1.setTextAlignment(TextAlignment.CENTER);
		c1.setFont(new Font("Arial", 12));
		//styling for rows and labels
		String stylebox = "-fx-border-color: blue;" + "-fx-background-color: rgba(255, 255, 255, 10)";
		a1.setStyle(stylebox);
		a1.setPrefSize(120.00, 80.00);
		b1.setStyle(stylebox);
		b1.setPrefSize(120.00, 80.00);
		c1.setStyle(stylebox);
		c1.setPrefSize(120.00, 80.00);
		row1.setPadding(new Insets(10, 10, 10, 10));
		row1.getChildren().addAll(a1, b1, c1);
		row1.setMaxWidth(380);

		//////////////////////////////////////////////////////////////////////////////////////////////
		//create a HBox for row 2 of products
		HBox row2 = new HBox(10);
		//label for location a2
		Label a2 = new Label();
		a2.setText(String.format("       A2%n%s, €%.2f, %d", this.vendingmachine.getProductName(1),
				this.vendingmachine.getProductPrice(1), this.vendingmachine.getProductCount(1)));
		a2.setTextAlignment(TextAlignment.CENTER);
		a2.setFont(new Font("Arial", 12));
		//label for location b2
		Label b2 = new Label();
		b2.setText(String.format("       B2%n%s, €%.2f, %d", this.vendingmachine.getProductName(6),
				this.vendingmachine.getProductPrice(6), this.vendingmachine.getProductCount(6)));
		b2.setTextAlignment(TextAlignment.CENTER);
		b2.setFont(new Font("Arial", 12));
		//label for location c2
		Label c2 = new Label();
		c2.setText(String.format("       C2%n%s, €%.2f, %d", this.vendingmachine.getProductName(11),
				this.vendingmachine.getProductPrice(11), this.vendingmachine.getProductCount(11)));
		c2.setTextAlignment(TextAlignment.CENTER);
		c2.setFont(new Font("Arial", 12));
		//styling for labels and hbox
		String stylebox2 = "-fx-border-color: blue;" + "-fx-background-color: rgba(255, 255, 255, 10)";
		a2.setStyle(stylebox2);
		a2.setPrefSize(120.00, 80.00);
		b2.setStyle(stylebox2);
		b2.setPrefSize(120.00, 80.00);
		c2.setStyle(stylebox2);
		c2.setPrefSize(120.00, 80.00);
		row2.setPadding(new Insets(10, 10, 10, 10));
		row2.getChildren().addAll(a2, b2, c2);
		row2.setMaxWidth(380);

		///////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// a hbox for row 3 of products and locations
		HBox row3 = new HBox(10);
		//create label for a1 location
		Label a3 = new Label();
		a3.setText(String.format("       A3%n%s, €%.2f, %d", this.vendingmachine.getProductName(2),
				this.vendingmachine.getProductPrice(2), this.vendingmachine.getProductCount(2)));
		a3.setTextAlignment(TextAlignment.CENTER);
		a3.setFont(new Font("Arial", 12));
		//label for b2 location
		Label b3 = new Label();
		b3.setText(String.format("       B3%n%s, €%.2f, %d", this.vendingmachine.getProductName(7),
				this.vendingmachine.getProductPrice(7), this.vendingmachine.getProductCount(7)));
		b3.setTextAlignment(TextAlignment.CENTER);
		b3.setFont(new Font("Arial", 12));
		//label for c3 location
		Label c3 = new Label();
		c3.setText(String.format("       C3%n%s, €%.2f, %d", this.vendingmachine.getProductName(12),
				this.vendingmachine.getProductPrice(12), this.vendingmachine.getProductCount(12)));
		c3.setTextAlignment(TextAlignment.CENTER);
		c3.setFont(new Font("Arial", 12));
		//styling of labels
		String stylebox3 = "-fx-border-color: blue;" + "-fx-background-color: rgba(255, 255, 255, 10)";
		a3.setStyle(stylebox3);
		a3.setPrefSize(120.00, 80.00);
		
		b3.setStyle(stylebox3);
		b3.setPrefSize(120.00, 80.00);
		
		c3.setStyle(stylebox3);
		c3.setPrefSize(120.00, 80.00);
		
		row3.getChildren().addAll(a3, b3, c3);
		row3.setPadding(new Insets(10, 10, 10, 10));
		row3.setMaxWidth(380);

		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//a Hbox for a row of products and locations
		HBox row4 = new HBox(10);
		//label for a4
		Label a4 = new Label();
		a4.setText(String.format("       A4%n%s, €%.2f, %d", this.vendingmachine.getProductName(3),
				this.vendingmachine.getProductPrice(3), this.vendingmachine.getProductCount(3)));
		a4.setTextAlignment(TextAlignment.CENTER);
		a4.setFont(new Font("Arial", 12));
		//label for b4
		Label b4 = new Label();
		b4.setText(String.format("       B4%n%s, €%.2f, %d", this.vendingmachine.getProductName(8),
				this.vendingmachine.getProductPrice(8), this.vendingmachine.getProductCount(8)));
		b4.setTextAlignment(TextAlignment.CENTER);
		b4.setFont(new Font("Arial", 12));
		Label c4 = new Label();
		//label for c4
		c4.setText(String.format("       C4%n%s, €%.2f, %d", this.vendingmachine.getProductName(13),
				this.vendingmachine.getProductPrice(13), this.vendingmachine.getProductCount(13)));
		c4.setTextAlignment(TextAlignment.CENTER);
		c4.setFont(new Font("Arial", 12));
		//Styling for labels and box
		String stylebox4 = "-fx-border-color: blue;" + "-fx-background-color: rgba(255, 255, 255, 10)";
		a4.setStyle(stylebox4);
		a4.setPrefSize(120.00, 80.00);
		b4.setStyle(stylebox4);
		b4.setPrefSize(120.00, 80.00);
		c4.setStyle(stylebox4);
		c4.setPrefSize(120.00, 80.00);
		
		row4.setPadding(new Insets(10, 10, 10, 10));
		row4.getChildren().addAll(a4, b4, c4);
		row4.setMaxWidth(380);

		/////////////////////////////////////////////////////////////////////////////////////////////////////////
		//create hbox for row 5
		HBox row5 = new HBox(10);
		//label for location a5
		Label a5 = new Label();
		a5.setText(String.format("       A5%n%s, €%.2f, %d", this.vendingmachine.getProductName(4),
				this.vendingmachine.getProductPrice(4), this.vendingmachine.getProductCount(4)));
		a5.setTextAlignment(TextAlignment.CENTER);
		a5.setFont(new Font("Arial", 12));
		Label b5 = new Label();
		//label for location b5
		b5.setText(String.format("       B5%n%s, €%.2f, %d", this.vendingmachine.getProductName(9),
				this.vendingmachine.getProductPrice(9), this.vendingmachine.getProductCount(9)));;
		b5.setTextAlignment(TextAlignment.CENTER);
		b5.setFont(new Font("Arial", 12));
		//label for location c5
		Label c5 = new Label();
		c5.setText(String.format("       C5%n%s, €%.2f, %d", this.vendingmachine.getProductName(14),
				this.vendingmachine.getProductPrice(14), this.vendingmachine.getProductCount(14)));		
		c5.setTextAlignment(TextAlignment.CENTER);
		c5.setFont(new Font("Arial", 12));
		//styling for labels and box
		String stylebox5 = "-fx-border-color: blue;" + "-fx-background-color: rgba(255, 255, 255, 10)";
		a5.setStyle(stylebox5);
		a5.setPrefSize(120.00, 80.00);
		b5.setStyle(stylebox5);
		b5.setPrefSize(120.00, 80.00);
		c5.setStyle(stylebox5);
		c5.setPrefSize(120.00, 80.00);
		row5.setPadding(new Insets(10, 10, 10, 10));
		row5.getChildren().addAll(a5, b5, c5);
		row5.setMaxWidth(380);

		///////////////////////////////////////////////////////////////////////////////////
		//Hbox for the title
		title = new HBox();
		Label title1 = new Label("   Products");
		title1.setTextAlignment(TextAlignment.CENTER);
		title1.setFont(new Font("Arial", 18));
		title.getChildren().add(title1);
		title.setPadding(new Insets(10, 10, 10, 10));
		//////////////////////////////////////////////////////////////////////////////////////
		//create a new pane for the two type of user menu
		userMenuPane = new BorderPane();
		locations = new VBox(15);

		locations.getChildren().addAll(row1, row2, row3, row4, row5);
		userMenuPane.setLeft(locations);
		userMenuPane.setTop(title);

		userMenuPane.setCenter(rightside);
		String style = "-fx-background-color: rgba(100, 100, 255, 10)";
		userMenuPane.setStyle(style);
		userMenuPane.setBackground(Background.EMPTY);

		userMenuScene = new Scene(userMenuPane, 600, 500);
		window.setScene(userMenuScene);
		window.setTitle("Vending Machine Menu");
		window.show();
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	// *****************************ADMIN
	////////////////////////////////////////////////////////////////////////////////////////////////////////// MENU************************************************
// a method to create the admin menu layout that has different right side to client menu
	private void getAdminMenu() {

		rightside = new VBox(10);
		//messagebox for changing welcome message based on user action
		if (messageBox.getText().isEmpty()) {
			reloadMessage = "Welcome";
		}
		messageBox.setText(String.format("%s", reloadMessage));
		messageBox.setFont(new Font("Arial", 14));
		//labels
		Label reload = new Label();
		reload.setText("Reload products");
		reload.setFont(new Font("Arial", 14));
		
		Label name = new Label();
		name.setText("Enter product name:");
		name.setFont(new Font("Arial", 14));
		
		Label location = new Label();
		location.setText("Enter the location:");
		location.setFont(new Font("Arial", 14));
		
		Label price = new Label();
		price.setText("Enter the price:");
		price.setFont(new Font("Arial", 14));
		
		Label quantity = new Label();
		quantity.setText("Enter the quantity:");
		quantity.setFont(new Font("Arial", 14));
		
		Label logout = new Label();
		logout.setText("Would you like to logout?");
		//textfields
		tfName = new TextField();
		tfName.setMaxWidth(80);
		
		tfLocation = new TextField();
		tfLocation.setMaxWidth(80);
		
		tfPrice = new TextField();
		tfPrice.setMaxWidth(80);
		
		tfQuantity = new TextField();
		tfQuantity.setMaxWidth(80);
		
		
		//add all components to the vBox which will display rightside.
		rightside.getChildren().addAll(messageBox, reload, name, tfName, location, tfLocation, price, tfPrice, quantity,
				tfQuantity, (buttons.get("addProducts")), logout, (buttons.get("logout")), buttons.get("shutdown"));
		try {
//add vbox to the getproducts components to create menu.
			getProducts();

		} catch (FileNotFoundException e) {
			System.out.print("No Product file found");
			e.printStackTrace();
		}
	}

	////////////////////////////////////////////////////////////////////////////////////////////////
	//a method to reload the products in the machine
	public void reload() {
		try {//check that the fields are filled
			if (tfName.getText().isEmpty() || tfLocation.getText().isEmpty() || tfPrice.getText().isEmpty()
					|| tfQuantity.getText().isEmpty()) {
				reloadMessage = "No input. Please complete";

			} else {
				//get userinput
				String name = tfName.getText();
				String location = tfLocation.getText();
				String price = tfPrice.getText();
				String quantity = tfQuantity.getText();

				double priceDouble = Double.parseDouble(price);
				int quantityInt = Integer.parseInt(quantity);
				//call add product method and use return Strig to load user feedback message.
				reloadMessage = vendingmachine.addProduct(name, location, priceDouble, quantityInt);

			}
		} catch (NumberFormatException ex) {//check for valid numeric input
			System.out.println("Not a valid number!");

		} finally {
			getAdminMenu();//go back to menu
		}

	}

	///////////////////////////////////////////////////////////////////////////////////////////
	// a mthod to buy from the vending machine
	
	private void buy() throws PurchaseException, FileNotFoundException {
		//message update
		String buyMessage = "Welcome";
		location = enterLocation.getText();
		try {//use return from calling buy method as user feedback
			buyMessage = vendingmachine.buy(location, userDataIndex);
		} catch (IOException e) {
			System.out.print("No product file found");
			e.printStackTrace();
		}
		//Adapt the rightside Vbox for next purchase or action
		rightside = new VBox(10);
		Label buyMessage2 = new Label();
		buyMessage2.setText(String.format("%s", buyMessage));
		buyMessage2.setFont(new Font("Arial", 16));
		Label success = new Label();
		success.setText("Would you like to buy more?");
		success.setFont(new Font("Arial", 16F));
		Label credit = new Label();
		credit.setText(String.format("Your balance is: € %.2f", vendingmachine.getUserCredit(userDataIndex)));
		credit.setFont(new Font("Arial", 16));
		Label location = new Label();
		location.setText("Enter the location:");
		location.setFont(new Font("Arial", 16));
		enterLocation = new TextField();
		enterLocation.setMaxWidth(80);
		Label logout = new Label();
		logout.setText("Would you like to logout?");
		logout.setFont(new Font("Arial", 16));

		rightside.getChildren().addAll(buyMessage2, success, credit, location, enterLocation, (buttons.get("buy")),
				logout, (buttons.get("logout")));
		//get products(left) side of menu
		getProducts();
	}

	////////////////////////////////////////////////////////////////////////////////
	// *********************************LOGOUT********************************************
	//a method to log the user out and return to login
	public void logout() {
		//vlear fields for next user
		tfUsername.clear();
		tfPassword.clear();
		//recreate the login box
		loginPane = new BorderPane();
		loginFields = getLoginFields();
		loginPane.setCenter(loginFields);
		String style = "-fx-background-color: rgba(100, 255, 255, 0.5);";
		loginPane.setStyle(style);
		loginPane.setBackground(Background.EMPTY);

		login = new Scene(loginPane, 350, 450);
		login.setFill(Color.TRANSPARENT);

		window.setScene(login);
		window.setTitle("Vending Login");

	}

	/////////////////////////////////////////////////////////////////////////////////////////////
	// a method to shutdown the app and save changed data for csv files.
	
	public void shutdown() {
		try {
			vendingmachine.shutdown();
			window.close();
		} catch (IOException e) {
			System.out.print("No file found");
			e.printStackTrace();
		}
	}
}
