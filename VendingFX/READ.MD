 # VENDING MACHINE PROJECT
 A vending machine system that has all the usual Vending machine functionalities with a GUI (Java FX).

The vending machine is a money-less operation where clients buy credit using an App and can then use that credit to buy bars in the vending machines, make photocopies in the library and buy meals in the café. 

This app is not part of the specification for this project. Instead the vending machine software loads up the ‘client’ file that is updated by that app when the vending machine is started up. The file contains the user’s username, current credit and password.

To buy a product the user has to identify themselves (username and password), have enough credit and specify the product location in the vending machine. 

An admin person also has a user name and password is allowed to add/reload products back into the vending machine and “shut the system down” for the night. This shutdown process stores the current product (products, location, price and amount) information to another csv file called product.dat that is reloaded on product start-up.

The main functionality of the program:

It incorporates the persistent files into the system, as specified above;

Provides a graphical user interface (GUI) to the system using JavaFX; 

Offers operator authentication services. This requires changes to the user interface to distinguish between an admin operator (who can restock the machine, do the end-of-day procedure and logout) and a ‘normal’ client who can interact with the machine to view all products, buy a product and logout. 
]

