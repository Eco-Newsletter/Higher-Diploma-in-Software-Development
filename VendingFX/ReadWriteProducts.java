package Vendingfx;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;

public class ReadWriteProducts {
	private ArrayList<Product>products;
	private String productsFilename;


	public ReadWriteProducts(String productsFilename) {
		
		products = new ArrayList<Product>();
		this.productsFilename = productsFilename;
	}



////////////////////////////////////////////////////////////////////////////////////////////////////
public void readProducts() throws FileNotFoundException {
	String csvFile = this.productsFilename;//"src/Vendingfx/Clients.csv";
    String line = "";
    String cvsSplitBy = ", ";

    try (BufferedReader productInput = new BufferedReader(new FileReader(csvFile))) {

        while ((line = productInput.readLine()) != null) {
        	String[] productData =  line.split(cvsSplitBy);
        	String productName = productData[0];
        	String productLocation = productData[1];
        	Double price = Double.parseDouble(productData[2]);
        	int quantity = Integer.parseInt(productData[3]);
        	products.add(new Product(productName, productLocation, price, quantity));
        }
    } catch (IOException e) {
        System.out.print("Enter a valid Products file");;
    }
}
public ArrayList<Product> getArrayProd (){
	return products;
}
///////////////////////////////////////////////////////////////////////////////////////////////

	
///////////////////////////////////////////////////////////////////////////////////////////////////
public String getName(int index) {
	String name = products.get(index).getDescription();
	return name;
}
///////////////////////////////////////////////////////////////////////////////////////////////////
public String getLocation(int index) {
	String location = products.get(index).getLocationId();
	return location;
}
//////////////////////////////////////////////////////////////////////////////////////////////
public double getPrice(int index) {
	double price = products.get(index).getPrice();
	return price;
	
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
public int getQuantity(int index) {
	int quantity = products.get(index).getQuantity();
	return quantity;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
public void displayList() {
	for (int i = 0; i<products.size(); i++) {
	System.out.println(products.get(i).toString());
	}
}
}