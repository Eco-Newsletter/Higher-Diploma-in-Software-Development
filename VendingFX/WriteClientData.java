package Vendingfx;

import java.io.DataOutputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;

//import jdk.internal.org.jline.reader.impl.DefaultParser.ArgumentList;

public class WriteClientData {
	//ReadUserData db;
	
	public WriteClientData() {
		//this.db = new ReadUserData();
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public void writeClients(String filename, ReadUserData userData) throws IOException {
		//userData.readClients();
		
		try (
				PrintWriter output = new PrintWriter(filename);
				)//("src/Vendingfx/Clients.csv");)

		{

			for (int i = 0; i < userData.getArray().size(); i++) {
				if (userData.getUserType(i).equalsIgnoreCase("client")) {
					output.printf("%s, %.2f, %s%n", userData.getUsername(i), userData.getCredit(i),
							userData.getPassword(i));
				}
				

			}
		}
	}



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	public void writeAdmin(String filename, ReadUserData userData) throws IOException {
		//userData.readAdmin();
		try (PrintWriter output = new PrintWriter(filename);)//("src/Vendingfx/Admin.csv");)

		{

			for (int i = 0; i < userData.getArray().size(); i++) {
				if (userData.getUserType(i).equalsIgnoreCase("admin")) {
					output.printf("%s, %s%n", userData.getUsername(i), userData.getPassword(i));
				}

			}
		}
	}

}
		
		
		/*(DataOutputStream output = new DataOutputStream(new FileOutputStream("src/Vendingfx/Clients.csv"));
				){
			String newLine = System.getProperty("line.separator");
			 
			output.writeUTF("John");
			output.writeUTF("0000");
			output.writeUTF("85.50");
			//output.writeUTF(newLine);
			output.writeUTF("Fred");
			output.writeUTF("0001");
			output.writeDouble(67.50);
			//output.writeUTF(newLine);
			output.writeUTF("james");
			output.writeUTF("0002");
			output.writeDouble(87.50);
		}*/


	

