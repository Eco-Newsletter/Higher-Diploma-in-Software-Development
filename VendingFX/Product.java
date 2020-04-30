package Vendingfx;

/**
A product in a vending machine.
*/
public class Product
{  
private String description;
private double price;
private int quantity;
private String locationId;

/**
   Constructs a Product object
   @param aDescription the description of the product
   @param aPrice the price of the product
   @param locationId
   @param quantity
*/
//////////////////////////////////////////////////////////////////////////////////////
public Product(String aDescription, String locationId, double aPrice, int quantity)
{  
	this.locationId = locationId;
	this.quantity = quantity;
   this.description = aDescription;
   this.price = aPrice;
   
}

////////////////////////////////////////////////////////////////////////////
/**
 * get quantity of product
 * @return int
 */

public int getQuantity() {
	return quantity;
}
///////////////////////////////////////////////////////////////////////////////////////
/**
 * get Name of product
 * @return String
 */
public String getDescription()
{ 
   return description;
}
////////////////////////////////////////////////////////////////////////////////////////
/**
   Gets the locationid.
   @return the locationid 
*/
public String getLocationId() {
	return this.locationId;
}
////////////////////////////////////////////////////////////////////////////////////////
/**
 * get the price
 * @return price
 */
public double getPrice()
{  
   return this.price;
}
///////////////////////////////////////////////////////////////////////////////////////
/**
 * dipslay price in euros
 * @return price in euros
 */
public String displayPrice() {
	String displayPrice = ("€" + this.price);
	return displayPrice;
}
/////////////////////////////////////////////////////////////////////////////////////////////
/**
   Determines of this product is the same as the other product.
   @param other the other product
   @return true if the products are equal, false otherwise
*/
///////////////////////////////////////////////////////////////////////////
public boolean equals(Object other)
{ 
   if (other == null) return false;
   Product b = (Product) other;
   return description.equals(b.description) && price == b.price;
}


///////////////////////////////////////////////////////////////////////////
public boolean sell() {
	boolean sellprod = false;
	if(this.quantity>0) {
	this.quantity --;
	sellprod = true;
	}
	else {System.out.print("No products");
	}
	return sellprod;
	}

//////////////////////////////////////////////////////////////////////////////////////////////
//public void replace() {
//	this.quantity ++;
//}

///////////////////////////////////////////////////////////////////////////
/**
Formats the product's description, location, price and quantity.
*/
public String toString()
{ 
   
return this.description + " "+  this.locationId + " " + this.price + " " + this.quantity;
}
/////////////////////////////////////////////////////////////////////////////
}
//" @ €"+ 