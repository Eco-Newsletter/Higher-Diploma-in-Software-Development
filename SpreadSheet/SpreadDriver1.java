public class SpreadDriver
	{
	    
	    public static void main (String[] args)
	    { 
	        //create an instance of the class using the default constructor//
	        
	        SpreadSheet myExample;
	        myExample = new SpreadSheet();
	        
	        //using the Spreadsheet//
	        System.out.printf("The sheets in the list by default are: \n");
	        myExample.display();
	        myExample.add();
	        
	        System.out.printf("Now I have added another sheet with the next number. \n");
	        myExample.display();
	        
	        myExample.add("Wow");
	        System.out.printf("Now I have added another sheet that I have named 'wow' \n");
	        myExample.display();
	        
	        System.out.printf("The length of the Spreadsheet List is %d \n", 
	        myExample.length());
	        
	        myExample.add();
	        System.out.printf("If I add another sheet it will be Sheet 5 \n");
	        myExample.display();
	                
	        myExample.add("Sheet6");
	        System.out.printf("I added sheet 6 myself.\n");
	        myExample.display();
	        
	        myExample.add();
	        System.out.printf("When I add another one it knows there is already a sheet6 so will add sheet7.\n");
	        myExample.display();
	        
	        int i;
	        for(i=9; i <= myExample.lengthArray(); i++){
	            myExample.add();
	        }
	        System.out.printf("When the array gets full and there is no more space but i try to add one more it returns: %s\n", myExample.add());
	        
	        int j;
	        for(j =myExample.lengthArray(); j > 1; j--){
	            myExample.removenum(j);
	        }
	        System.out.printf("When I try to remove all the sheets, it won't let me remove the last one and returns: %s\n", myExample.removenum(0));
	        
	        System.out.printf("Now if I look the last sheet is:\n");
	        myExample.display();
	        
	        System.out.printf("Now if I try to remove one using 'sheet1' it will return: %d\n", myExample.remove("sheet1"));
	        
	        SpreadSheet anotherInstance = new SpreadSheet(10);
	        
	        System.out.printf("Lets start a new instance with another 3 sheets...\n");
	        anotherInstance.display();
	        
	        System.out.printf("I want to rename sheet 2 to programming, if it works it should return %d\n", anotherInstance.rename("sheet2", "programming"));
	        System.out.printf("Lets take a look to see if it has replaced sheet 2\n");
	        anotherInstance.display();
	        
	        System.out.printf("However, if I try to rename a sheet that doesn't exist it should do nothing and return %d\n", anotherInstance.rename("nothinghere", "anyname"));
	        System.out.printf("Lets check\n");
	        anotherInstance.display();
	        
	        System.out.printf("Lets add a few more sheets\n");
	        anotherInstance.add();
	        anotherInstance.add();
	        anotherInstance.add();
	        anotherInstance.display();
	        
	        System.out.printf("Now why don't we move them around.\n");
	        
	        System.out.printf("Move 2 to before 5, so sheet:%s\n", anotherInstance.move(2, 5, true));
	        anotherInstance.display();
	        
	        System.out.printf("Now lets moved 1 to after 4, the sheet moved is %s\n", anotherInstance.move(1, 4, false));
	        anotherInstance.display();
	        
	        System.out.printf("now lets move 4 to before 1, the sheet moved is %s\n", anotherInstance.move(4,1,true));
	        anotherInstance.display();
	        
	        System.out.printf("Now lets check the boundaries, so move index 1 to after 6, sheet moved is %s\n", anotherInstance.move(1, 6, false));
	        anotherInstance.display();
	        
	        System.out.printf("Lets move sheet from index 6 to before 1 %s\n", anotherInstance.move(6, 1, true));
	        anotherInstance.display();
	        
	        System.out.printf("Now an index that doesn't exist so 0 to after 7, it should do nothing and say: %s \n", anotherInstance.move(1, 8, false));
	        anotherInstance.display();
	        System.out.printf("And again, swapping 8 and 4..it should say: %s\n", anotherInstance.move(8,4,true));
	        anotherInstance.display();
	        
	        System.out.printf("Lets check more boundaries...what if the whole array is full and we try some swaps?\n");
	        
	        for(i = 6; i <= anotherInstance.lengthArray(); i++){
	            anotherInstance.add();
	        }
	        
	        anotherInstance.display();
	    
	        System.out.printf("Lets move index 1 to after index 10, it moves: %s\n", anotherInstance.move(1,10, false));
	        System.out.printf("so now the last element should be: %s \n", anotherInstance.sheetName(10));
	     
	        
	        System.out.printf("Lets move 10 to before 1, it moves: %s\n", anotherInstance.move(10,1,true));
	        System.out.printf("so now the first element is: %s\n", anotherInstance.sheetName(1));
	        
	      
	        System.out.printf("Now move them by using their name, if it works it will return the index of the moved item. So move programming to after Sheet3. Index %d\n", anotherInstance.move("programming", "sheet3", false));
	        anotherInstance.display();
	        
	        System.out.printf("Now lets move them again so programming will move to before sheet 6 so index: %s\n", anotherInstance.move("programming", "sheet6", true));
	        anotherInstance.display();
	        
	        System.out.printf("If I make a mistake and try to move a file that doesn't exist, it will show: %d \n", anotherInstance.move("fake", "sheet10", true));
	        anotherInstance.display();
	        
	        System.out.printf("I will try to rename another sheet as programming but it won't work it will show: %d\n", anotherInstance.rename("programming", "sheet3"));
	        anotherInstance.display();
	  
	        System.out.printf("Lets moved sheet 1 to the end, it will now be in index: %d\n", anotherInstance.moveToEnd("sheet1"));
	        anotherInstance.display();
	        
	        System.out.printf("I can't remember where programming is...lets check, it is in: %d\n", anotherInstance.index("programming"));
	        
	        System.out.printf("What is in index 1? %s\n", anotherInstance.sheetName(1));
	        
	        System.out.printf("Almost finished. Lets move index 1 to the end, the name of the sheet is: %s\n", anotherInstance.moveToEnd(1));
	        anotherInstance.display();
	        
	        System.out.printf("Finally, lets try to move a sheet to the end that doesn't exist, it will say: %d\n",anotherInstance.moveToEnd("missing"));

	    }
	}

