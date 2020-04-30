package Vendingfx;

import java.io.FileNotFoundException;

public class Location {

	private String position;
	private int productsCount;
	private Product product;

	public Location(String position) {
		
		this.position = position;
			
	}
	
	////////////////////////////////////////////////////////////////////////////////
	public void resetProduct() {
		this.product = null;
	}
	////////////////////////////////////////////////////////////////////////////////////
	public String addProduct(Product product) {
		String addMessage = "Welcome";
		if (this.product == null && product.getQuantity()<11) {
			addMessage = "You product has been loaded";
			this.product = product;
			this.productsCount = this.product.getQuantity();
		}
		else if(this.product == null && product.getQuantity()>10) {
			addMessage = "Only 10 products allowed";
		}
		
		
		else if ((this.product.getDescription().equalsIgnoreCase(product.getDescription()))
				&& ((this.product.getPrice()== product.getPrice()))&& (10 - this.product.getQuantity() >= product.getQuantity()) && (10 - productsCount >= product.getQuantity()))
		{
			addMessage = "You product has been loaded ";
			this.productsCount += product.getQuantity(); 
			
		}
		else if(!this.product.equals(product) && getProductsCount()==0) {
			addMessage = "Your product has been loaded";
			this.product = product;
			this.productsCount = product.getQuantity();
			} 
		else{
			addMessage = "Choose a different location";
			product = null;
		}
		return addMessage;
		}
	////////////////////////////////////////////////////////////////////////////////////////////////////
	//public void uploadList(String filename, ReadWriteProducts productlist) throws FileNotFoundException {
	//	productlist.readProducts(filename);
		
	//}
		
	
	
	///////////////////////////////////////////////////////////////////////////
	public void setPosition(String position) {
		this.position = position;
	}
	//////////////////////////////////////////////////////////////////////////////
	
	public String getPosition() {
		return this.position;
	}
	//////////////////////////////////////////////////////////////////////////////
	public int getProductsCount() {
		int count= 0;
		if (this.product == null){
			
		}else {
	    count =  this.productsCount;
		}
		return count;
	}
	/////////////////////////////////////////////////////////////////////////////
	public Product getProduct() {
		return this.product;
	}
	
///////////////////////////////////////////////////////////////////////////////////////	
	//public void addProduct(int quantity) {
	//	productsCount += quantity;
	//}
	//////////////////////////////////////////////////////////////////////////////
	public void removeProduct() {
		if(product.sell()==true) {
		productsCount--;
	}else {System.out.print("No products");
		}
	}
	
	////////////////////////////////////////////////////////////////////////////////
	public String toString() {
		String toString = "";
		
		if(this.product==null) {
		
		}else {
		toString =  this.product.getDescription()+ ", " + this.position + ", "+ this.product.getPrice()  + ", " + this.productsCount;
		
		}
		return toString;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	public String display() {
		String toString = "hello";
		
		if(this.product==null) {
		
		}else {
		toString =  this.product.getDescription()+ ", " + this.position + ", "+ this.product.getPrice()  + ", " + this.productsCount;
		
		}
		return toString;
	}
	
	//////////////////////////////////////////////////////////////////
public int getProductQuantity() {
	return this.product.getQuantity();
}
/////////////////////////////////////////////////////////////////////////////
public String getProductName() {	
	String name = "Empty";
	if (this.product == null){
		
	}else {
    name = this.product.getDescription();
	}
	return name;
}
////////////////////////////////////////////////////////////////

public double getProductprice() {
	double price = 0;
	if (this.product == null){
		
	}else {
    price = this.product.getPrice();
	}
	return price;
}
/////////////////////////////////////////////////////////////////////////////
public String getProductLocation() {
	return this.product.getLocationId();
}
//public void replaceProduct() {
//	productsCount++;
//	product.replace();
//	}
	}

