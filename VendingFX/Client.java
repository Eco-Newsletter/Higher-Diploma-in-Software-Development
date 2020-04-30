package Vendingfx;

public class Client extends User {
	double credit;
	String type;
	
	public Client(String username,  double credit, String password) {
		super(username, password);
		this.credit = credit;
		this.type = "Client";
	}

////////////////////////////////////////////////////////////////////////////////////

@Override

public String toString() {
	return this.username + " " + this.credit + " " + this.password + " " ;
}
//////////////////////////////////////////////////////////////////////////////////
@Override
public boolean authenticate(String username, String password) {
	boolean match = false;
	
       if (this.username.equals(username) && this.password.equals(password) ){
    	   
    	   match = true;
       }
       return match;
}
////////////////////////////////////////
public double getCredit() {
	return this.credit;
}
///////////////////////////////////////////////////////////////////////
public String displayCredit() {
	return  "€"+ this.credit;
}
///////////////////////////////////////////////////////////////////////////
public void logout() {
	
}
//////////////////////////////////////////////////////////////////////////////////////
public String getUserType() {
	return this.type;
}
/////////////////////////////////////////////////////////////////////////////////////////////
public double buy(double spendAmount)throws PurchaseException {
	if(this.credit > spendAmount) {
	this.credit = this.credit - spendAmount;
	}else {
		throw new PurchaseException("Insufficient money");
	}
	return this.credit;
}
///////////////////////////////////////////////////////////////////////////
}