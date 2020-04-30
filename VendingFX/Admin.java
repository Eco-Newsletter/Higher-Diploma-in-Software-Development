package Vendingfx;

public class Admin extends User {

	String type;

//////////////////////////////////////////////////////////////////////////////////
	public Admin(String username, String password) {
		super(username, password);
		this.type = "Admin";
	}

	///////////////////////////////////////////////////////////////////////
	public boolean authenticate(String username, String password) {
		boolean match = false;

		if (this.username.equals(username) && this.password.equals(password)) {

			match = true;

		}
		return match;
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	public String getUserType() {
		return this.type;
	}
}
