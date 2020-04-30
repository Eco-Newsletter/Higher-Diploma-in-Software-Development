package Vendingfx;

import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;

import javafx.scene.text.Font;
// a class tp create a vending machine and all its functions
public class VM {
//Fields.  VM contains a userdata, locations, products and files.
	private ReadUserData userDatabase;
	private ArrayList<Location> locations;
	private ReadWriteProducts productList;
	private String userFilename, adminFilename, productsFilename;
//enter file paths
	public VM(String userFilename, String adminFilename, String productsFilename) {
		this.userFilename = userFilename;
		this.adminFilename = adminFilename;
		this.productsFilename = productsFilename;
		this.userDatabase = new ReadUserData(this.userFilename, this.adminFilename);
		this.productList = new ReadWriteProducts(this.productsFilename);
		//initialise the locations
		locations = new ArrayList<Location>();
		locations.add(new Location("A1"));
		locations.add(new Location("A2"));
		locations.add(new Location("A3"));
		locations.add(new Location("A4"));
		locations.add(new Location("A5"));
		locations.add(new Location("B1"));
		locations.add(new Location("B2"));
		locations.add(new Location("B3"));
		locations.add(new Location("B4"));
		locations.add(new Location("B5"));
		locations.add(new Location("C1"));
		locations.add(new Location("C2"));
		locations.add(new Location("C3"));
		locations.add(new Location("C4"));
		locations.add(new Location("C5"));

	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
	// a method that calls the readuserdata class to read the data into an array and create a type of storage.
	public void readUsers() {
		try {
			this.userDatabase.readClients();
		} catch (FileNotFoundException e) {
			System.out.print("Client file missing");
			e.printStackTrace();
		}
		try {
			this.userDatabase.readAdmin();
		} catch (FileNotFoundException e) {
			System.out.print("Admin file missing");
			e.printStackTrace();
		}
	}

//////////////////////////////////////////////////////////////////////////////////////////
//a mehtod that calls on readuserdata mthods to write the changed data back to files
	public void writeUserFile() throws IOException {
		this.userDatabase.writeClients();
		this.userDatabase.writeAdmin();
	}

///////////////////////////////////////////////////////////////////////////////////////////////
	//methods to read in products and put into the correct locations in vending machine
	
	public void readProducts() throws FileNotFoundException {
		this.productList.readProducts();
		int j = 0;

		while (j < this.productList.getArrayProd().size()) {
			for (int i = 0; i < locations.size(); i++) {
				if (this.locations.get(i).getPosition().equalsIgnoreCase(this.productList.getLocation(j))) {
					this.locations.get(i)
							.addProduct(new Product(this.productList.getName(j), this.productList.getLocation(j),
									this.productList.getPrice(j), this.productList.getQuantity(j)));
					break;
				}

			}
			j++;
		}
	}

///////////////////////////////////////////////////////////////////////////////////////////
	//a mthod to get user type for login
	public String getUserType(int index) {
		if (userDatabase.getArray().get(index).getUserType().equals("client"))
			;
		return userDatabase.getArray().get(index).getUserType();

	}

////////////////////////////////////////////////////////////////////////////////////////
//a mthod to get user credit
	public double getUserCredit(int index) {

		return userDatabase.getCredit(index);
	}

///////////////////////////////////////////////////////////////////////////////////////////////////
	// a mthod to write product file sback on shutdown
	public void writeProductFile() throws IOException {

		try (PrintWriter output = new PrintWriter(this.productsFilename);) {// ("src/Vendingfx/Clients.csv");
			for (int i = 0; i < locations.size(); i++) {//writes the contents of all locations not the products array as locations have updated quantities
				if (!locations.get(i).display().equalsIgnoreCase("hello"))
					output.printf("%s%n", locations.get(i).display());
			}
		}
	}


	
///////////////////////////////////////////////////////////////////////////////////////
// login method to check username and password with array created in readuserdata.
	//@return integer representing the user index in array.
	public int login(String username, String password) throws FileNotFoundException {
		return this.userDatabase.login(username, password);

	}

////////////////////////////////////////////////////////////////////////////////////////
	// a method for admin to add a product to a location, returns a feedback message for the user, calls on addProduct method in locations class.
	public String addProduct(String name, String locationId, double price, int quantity) {
		String addMessage = "No such location";
		for (int i = 0; i < this.locations.size(); i++) {
			if (this.locations.get(i).getPosition().equalsIgnoreCase(locationId)) {
				Product product = new Product(name, locationId, price, quantity);
				addMessage = this.locations.get(i).addProduct(product);
			}
		}
		return addMessage;
	}
///////////////////////////////////////////////////////////////////////////	
public String getProductName(int index) {
	String name = "Empty";
	if(locations.get(index).getProduct()!=null) {
		name =  this.locations.get(index).getProductName();
		
	}
	return name;
}
	///////////////////////////////////////////////////////////////////////////////////////
//displays the current products in locations
	public void displaylocations() {
		for (int i = 0; i < locations.size(); i++) {
			System.out.println(locations.get(i));
		}
	}


	/////////////////////////////////////////////////////////////////////////////
	//Displays list of products
	public void displayList() {
		this.productList.displayList();
	}

	/////////////////////////////////////////////////////////////////////////////
	//a method to get the price of a product and return it as a double
	public double getProductPrice(int index) {
		if (locations.get(index).getProduct() != null) {
			return this.locations.get(index).getProductprice();
		} else {
			return 0.0;
		}

	}

////////////////////////////////////////////////////////////////////////////////////////
	// a method to get the new count of a product in each location
	//returns number of products in a location
	public int getProductCount(int index) {
		if (this.locations.get(index).getProductsCount() != 0) {
			return this.locations.get(index).getProductsCount();
		} else
			return 0;
	}

////////////////////////////////////////////////////////////////////////////////////////
	// a method to get the location id of a location as a string
	//@return String
	public String getPosition(int index) {
		return this.locations.get(index).getPosition();
	}

//////////////////////////////////////////////////////////////////////////////////////////////
	// a method to remove products from the machine when purchased
	//returns the index of the removed product in the location array.
	
	public int remove(String LocationId) throws PurchaseException {
		int i = 0;

		for (i = 0; i < locations.size(); i++) {
			if ((this.locations.get(i).getPosition().equalsIgnoreCase(LocationId))
					&& (this.locations.get(i).getProductsCount() != 0)) {
				this.locations.get(i).removeProduct();
// if a product has 0 quantity then it will reset so the location is empty.
				if (this.locations.get(i).getProductsCount() == 0) {
					// System.out.print("No products available");
					this.locations.get(i).resetProduct();
					break;
				}

			}
		}

		return i;
	}

//////////////////////////////////////////////////////////////////////////////////////////

//***************************************BUY*************************************************//
// a method for the client to buy a product from a location.  It will reduce user credit and call remove method to remove product
	//returns a String which is a user feedback message
	public String buy(String LocationId, int userIndex) throws PurchaseException, IOException {
		int location = 0;
		String buyMessage = "Sorry make another choice";//message for user
		int count = 0;
		for (int i = 0; i < locations.size(); i++) {
			if (this.locations.get(i).getPosition().equalsIgnoreCase(LocationId)) {//check the location ids match
				location = i;

				try {

					if (this.locations.get(location).getProduct() != null) {//check the product exists

						((Client) this.userDatabase.getArray().get(userIndex))//if it exists call client buy method and change array
								.buy(this.locations.get(location).getProductprice());//reduce credit by the price of product in the location
						remove(LocationId);//remove prodcut from location

						buyMessage = "Enjoy your product";

					} else {
						buyMessage = "SORRY OUT OF STOCK";//if no product
					}

				} catch (PurchaseException ex) {
					buyMessage = "Insufficient Funds";//check for enough credit

				}
			} else {
				count++;//count if location is not found

			}

			if (count == locations.size()) {//if the location has not been found by end of array then they entered invalid location
				buyMessage = "Sorry no such location.";

			}
		}
		return buyMessage;

	}

////////////////////////////////////////////////////////////////////////////////////////////////
	// *******************************Product*******************************************//
	//a method to return the product
	public Product getProduct(int index) {
		Product dummy = new Product("Empty", "0", 0, 0);
		if (this.locations.get(index).getProduct() == null) {
			return dummy;//if not product then a dummy will be displayed in GUI
		} else {

			return this.locations.get(index).getProduct();
		}

	}

//////////////////////////////////////////////////////////////////////////////////////////////
	//a mthod to display user in array for testing
	public void displayUser(int index) {
		System.out.println("User:" + this.userDatabase.getArray().get(index));
	}
////////////////////////////////////////////////////////////////////////////////
	//display all users
	public void displayUsers() {
		for (int i = 0; i < this.userDatabase.getArray().size(); i++) {
			System.out.println(this.userDatabase.getArray().get(i));
		}
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// a mthod to shutdown machine.Stores all data back to files.
	public void shutdown() throws IOException {

		userDatabase.writeClients();
		userDatabase.writeAdmin();
		writeProductFile();

	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
}
