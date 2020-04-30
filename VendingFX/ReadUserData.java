package Vendingfx;

import java.io.BufferedReader;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.EOFException;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.Scanner;

public class ReadUserData {

	private static ArrayList<User> users;
	private String clientFilename, adminFilename;

	public ReadUserData(String clientFilename, String adminFilename) {
		users = new ArrayList<User>();
		this.clientFilename = clientFilename;
		this.adminFilename = adminFilename;
	}

//////////////////////////////////////////////////////////////////////////////////////////////////

	public void readClients() throws FileNotFoundException {

		String csvFile = this.clientFilename;
		String line = "";
		String cvsSplitBy = ", ";

		try (BufferedReader clientInput = new BufferedReader(new FileReader(csvFile))) {

			while ((line = clientInput.readLine()) != null) {
				String[] userData = line.split(cvsSplitBy);

				String username = userData[0];
				Double credit = Double.parseDouble(userData[1]);
				String password = userData[2];
				users.add(new Client(username, credit, password));

			}

		} catch (IOException e) {
			System.out.print("No file found");
		}

	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/*
	 * DataInputStream userinput = new DataInputStream(new
	 * FileInputStream("src/Vendingfx/Clients.csv"))){ boolean eof = false;
	 * while(!eof) { String username = userinput.readUTF(); String password =
	 * userinput.readUTF(); double credit = userinput.readDouble();
	 * System.out.print(credit); System.out.print(password);
	 * System.out.print(username); System.out.print("hello"); users.add(new
	 * Client(username, password, credit));
	 * 
	 * } catch (EOFException ex) { System.out.println("All data were read"); } catch
	 * (IOException ex) { ex.printStackTrace();
	 */

/////////////////////////////////////////////////////////////////////////////////////////////////
	public void readAdmin() throws FileNotFoundException {

		String csvFile = adminFilename;
		String line = "";
		String cvsSplitBy = ", ";

		try (BufferedReader adminInput = new BufferedReader(new FileReader(csvFile))) {

			while ((line = adminInput.readLine()) != null) {

				// use comma as separator

				String[] userData = line.split(cvsSplitBy);

				String username = userData[0];

				String password = userData[1];

				users.add(new Admin(username, password));

			}

		} catch (IOException e) {
			System.out.print("Enter valid Admin.csv");
		}
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//////////////////////////////////////////////////////////////////////////////

	public double getClientCredit(int client) {
		return ((Client) users.get(client)).getCredit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////

	public void writeClients() throws IOException {
		// userData.readClients();

		try (PrintWriter output = new PrintWriter(this.clientFilename);)// ("src/Vendingfx/Clients.csv");)

		{

			for (int i = 0; i < users.size(); i++) {
				if (getUserType(i).equalsIgnoreCase("client")) {
					output.printf("%s, %.2f, %s%n", getUsername(i), getCredit(i), getPassword(i));
				}

			}
		}
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////
	public void writeAdmin() throws IOException {
		// userData.readAdmin();
		try (PrintWriter output = new PrintWriter(this.adminFilename);)// ("src/Vendingfx/Admin.csv");)

		{

			for (int i = 0; i < users.size(); i++) {
				if (getUserType(i).equalsIgnoreCase("admin")) {
					output.printf("%s, %s%n", getUsername(i), getPassword(i));
				}

			}
		}
	}

	public String getUserType(int i) {
		return users.get(i).getUserType();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////
	public ArrayList<User> getArray() {
		return users;
	}
	///////////////////////////////////////////////////////////////////////////////////////////

	public void displayList() {
		for (int i = 0; i < users.size(); i++) {
			System.out.println(users.get(i).toString());
		}
	}
////////////////////////////////////////////////////////////////

	public int login(String username, String password) throws FileNotFoundException {

		int userIndexNumber = -1;
		for (int i = 0; i < users.size(); i++) {

			if (users.get(i).getUsername().equals(username) && users.get(i).getUserPassword().equals(password)) {
				// System.out.print("you are logged in");
				userIndexNumber = i;
				break;
			}

			else if (i == (users.size() - 1) && (!(users.get(i).getUsername().equals(username))
					|| !(users.get(i).getUserPassword().equals(password)))) {
				// System.out.print("invalid Login Details");
			}
		}
		return userIndexNumber;
	}
	/////////////////////////////////////////////////////////

	//////////////////////////////////////////////////////////////////////////////////////
	public String getUsername(int i) {
		return users.get(i).getUsername();
	}

	////////////////////////////////////////////////////////////////////////////
	public String getPassword(int i) {
		return users.get(i).getUserPassword();
	}
	//////////////////////////////////////////////////////////////////////////

	public Double getCredit(int i) {
		return ((Client) users.get(i)).getCredit();
	}
	
/////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
//option read and write files as data stream to be more 'efficient'
/*public void readAdmin() {

try(
DataInputStream userinput = new DataInputStream(new FileInputStream("src/Vendingfx/Admin.csv"))){
boolean eof = false;
while(!eof) {
String username = userinput.readUTF();
String password = userinput.readUTF();
//users.add(new User(username, password));
}
}
catch (EOFException ex) {
System.out.println("All data were read");
}
catch (IOException ex) {
ex.printStackTrace();

}
}*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
}

