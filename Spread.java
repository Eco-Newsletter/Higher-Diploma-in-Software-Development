/* Spreadsheet systems allow several sheets to be 
stored in a single spreadsheet workbook. */

{

	private String[] sheetNameList = null;
	private int nextSheetPos;
	private int newSpreadNum;

/* Constructor that initializes first three sheet number*/

	public SpreadSheet()
	{
		sheetNameList = new String[256];
		nextSheetPos = 3;
		sheetNameList[0] = "Sheet1";
		sheetNameList[1] = "Sheet2";
		sheetNameList[2] = "Sheet3";
		newSpreadNum = nextSheetPos + 1;

	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* Constructor that creates an array of a user specified size */
 
public SpreadSheet(int capacity)
	{
		sheetNameList = new String[capacity];
		nextSheetPos = 3;
		sheetNameList[0] = "Sheet1";
		sheetNameList[1] = "Sheet2";
		sheetNameList[2] = "Sheet3";
		newSpreadNum = nextSheetPos + 1;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* Adds a new entry into the sheet name list, 
unless it already contains 256 entries. If the 
remove operation is successful the method returns 
the index position of the sheet removed. 
Otherwise it returns -1.*/

public boolean add()
	{     
		if(nextSheetPos < sheetNameList.length)
		{
			sheetNameList[nextSheetPos] = new String ("Sheet" + newSpreadNum);
			if(nameExists(sheetNameList[nextSheetPos]) == false)
			{   
				nextSheetPos++;
				newSpreadNum++;    
			} else
				if(nameExists(sheetNameList[nextSheetPos]) == true)
				{
					newSpreadNum++;
					sheetNameList[nextSheetPos] = new String ("Sheet" + (newSpreadNum));
					nextSheetPos++;
					newSpreadNum++;
				}
			return true;
		}
		return false; 
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* Adds a new entry with a sheet name and checks if that names already exists*/

public boolean add(String newName)
	{
		int pos = 0;
		int i;
		String alphabet = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			for(i = 0; i < newName.length(); i++) 
			{ 
				pos = alphabet.indexOf(Character.toLowerCase(newName.charAt(i))); 
			}
				if(pos != -1)
				{
					if(nextSheetPos < sheetNameList.length)
					{
						if(nameExists(newName)== false)
						{
							sheetNameList[nextSheetPos] = new String(newName);
							nextSheetPos++;
							return true;
						}
					}
				}
				return false;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
/* Returns the length f the spreadsheet */

	public int lengthArray()
	{
		return sheetNameList.length;
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* Returns an integer value representing the number of items in the list. */

	public int length()
	{
		return nextSheetPos;
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/* Displays the names in the list on the screen. */

	public void display()
	{
		int i ;
		for(i = 0; i < nextSheetPos; i++)
		{
			System.out.println(sheetNameList[i]);
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
 /* Returns the index position of a name in the list */
    
	public int index(String sheetName)
	{
		int index = -1;
		int i;

		for(i = 0; i < nextSheetPos; i++)
		{
			if(sheetNameList[i].compareToIgnoreCase(sheetName)==0)
			{
				index = i+1;               
			}      
		}
		return index;
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/* Returns the name of the sheet at the specified index position */

	public String sheetName(int index)
	{
		index--;
		String sheetName="";
		if(index >=0 &&index < sheetNameList.length && 
				sheetNameList[index]!= null)
		{
			sheetName = new String (sheetNameList[index]);
		}else{
			sheetName = null;
		}
		return sheetName;
	}  
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
/* Changes the name of an existing sheet.
If the currentName is successfully changed to the newName 
then the method returns the index position of the sheet renamed. 
Otherwise it returns -1.*/

	public int rename(String currentName, String newName)
	{
		int i;
		int pos = 0;
		int sheetindex= -1;
		String alphabet = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXZ";
		for( i = 0; i < newName.length(); i++)
		{ 
				pos = alphabet.indexOf(Character.toLowerCase(newName.charAt(i))); 
		}
			if(pos != -1)
			{
				if(index(newName) == -1 && index(currentName) != -1)
				{ 
					sheetNameList[(index(currentName))-1]= new String (newName);
					sheetindex = (index(newName));
               }
			}
			return sheetindex;
		}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                
 /* Removes a sheet name from the list 
If the remove operation is successful the method returns
the index position of the sheet removed. 
Otherwise it returns -1.*/

	public int remove (String sheetName)
	{
		int j;
		int sheetindex = -1;
		int lastSheet = nextSheetPos-1;
		if(nextSheetPos>1)
		{
			if(index(sheetName) != -1)
			{
				sheetindex = (index(sheetName))+ 1;
					for(j = sheetindex; j < nextSheetPos -1; j++)
					{
						sheetNameList[j] = sheetNameList[j+1];    
					}
				sheetNameList[lastSheet]= null;
				nextSheetPos--;
			}    
		}
			return sheetindex;
	}
  
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* An overloaded version of remove that uses an index position instead of a name.
If the remove operation is successful the method returns the name of the
sheet removed. Otherwise it returns a null/empty string.*/

	public String removenum (int index)
	{
		index--;
		String sheetName = null;       
		int lastSheet = nextSheetPos - 1;
		int j;
		if(sheetName(index) != null && nextSheetPos > 1)
		{
			if(index >= 0 && index <= sheetNameList.length)
			{
				sheetName = new String (sheetNameList[index]);
					}
				for (j = index; j < nextSheetPos -1; j++)
				{
					sheetNameList[j] = sheetNameList[j+1];
				}
				sheetNameList[lastSheet] = null;
				nextSheetPos--;
			}
			return sheetName;
		}
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
/* Allows a sheet to be moved from its current position to the end of the list.
If it does not exist the moveToEnd operation does nothing (i.e. the list is unaffected). */

	public String moveToEnd(int from)
	{
		String sheetName = null;
		int i ;
		if(sheetName(from) != null)
		{
			sheetName = new String (sheetName(from));
			from--;
				for( i = from ; i < nextSheetPos-1; i++)
				{
					sheetNameList[i] = sheetNameList[i+1];
				}
			sheetNameList[nextSheetPos - 1] = new String (sheetName);      
		}
			return sheetName;
	}
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
/* An overloaded version of the moveToEnd using an index instead of a name. */

	public int moveToEnd(String from)
	{
		int output = -1;
		String sheetName;
		int i ;
		if(index(from) != -1)
		{
			output = (index(from))-1;
			sheetName= sheetNameList[output];
				for( i = (index(from)) -1 ; i < nextSheetPos-1; i++)
				{
					sheetNameList[i] = sheetNameList[i+1];
				}
			sheetNameList[nextSheetPos - 1] = new String (sheetName); 
			output = index(from);     
		}
			return output;
	}       
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /*Check to see if there is a sheet that already has that name*/

	public boolean nameExists(String sheetName)
	{
		int i;
		for(i = 0; i < nextSheetPos; i++)
		{
			if(sheetNameList[i].compareToIgnoreCase(sheetName)==0)
			{
				return true;
                   
			}
		}
		return false;
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////               
 /* Allows a sheet name to be moved from one position in the list to another.
If the move operation is successful the method returns the index of the position
 the sheet was moved to. Otherwise it returns -1. */
       
	public int move(String from, String to, boolean before)
	{
		int indexOutput= -1;
		int indexfrom = (index(from))-1;
		int indexto = (index(to))-1;
		int indextobefore = indexto - 1;
		int indextoafter = indexto + 1;
		String stringtemp = null;
		int i;
		int j;             
		if (indexfrom != -1 && indexto != -1 && from != to)
		{    
			if(indexfrom < indexto && indexto <= sheetNameList.length && indexfrom >= 0)
			{          
				if(before==true)
				{
					stringtemp = new String (sheetNameList[indexfrom]);
						for(i = indexfrom ; i < indexto-1; i++)
						{
							sheetNameList[i] = sheetNameList[i+1];
						}    
							sheetNameList[indextobefore]= stringtemp;
							indexOutput = (indextobefore) + 1;
				}else{
					stringtemp = sheetNameList[indexfrom];
						for(j = indexfrom; j < indexto; j++)
						{
							sheetNameList[j] = sheetNameList[j+1];
						}         
					sheetNameList[indexto] = stringtemp;
					indexOutput = (indexto) + 1;
				}
 
			}else if(indexfrom > indexto && indexto >= 0 && 
					indexfrom <=sheetNameList.length)
			{     
				if(before == true)
				{
					stringtemp = sheetNameList[indexfrom];
						for(i = indexfrom - 1; i >= indexto; i--)
						{
							sheetNameList[i+1] = sheetNameList[i];
						}    
					sheetNameList[indexto] = stringtemp;
					indexOutput = (indexto) + 1;
				}else
				{
					stringtemp = sheetNameList[indexfrom];
						for(j = indexfrom - 1; j >= indextoafter; j--)
						{
							sheetNameList[j+1] = sheetNameList[j];
						}
					sheetNameList[indextoafter] = stringtemp;
					indexOutput = (indextoafter) + 1;
				} 

			}
		}
		return indexOutput;
	}
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
/* an overloaded version of the move using indices instead of names */

	public String move(int from, int to, boolean before)
	{
		String output = null;
		String sheetName = "";
		int i;
		int j;      
		if (sheetName(from) != null && sheetName(to) != null && from != to)
		{
			from--;
			to--;
			int indexbeforeto = to -1;
			int indexafterto = to + 1;
				if(from < to && to < sheetNameList.length && from >= 0)
				{  
					if(before==true)
					{
						sheetName = new String (sheetNameList[from]);
							for(i = from ; i < to-1; i++)
							{
								sheetNameList[i] = sheetNameList[i+1];
							}    
						sheetNameList[indexbeforeto]= sheetName;
						output = new String (sheetName(indexbeforeto + 1));
					}else{
						sheetName = new String (sheetNameList[from]);
							for(j = from; j < to; j++)
							{
								sheetNameList[j] = sheetNameList[j+1];
							}         
						sheetNameList[to] = sheetName;
						output = new String (sheetName(to + 1));
					}
 
				}else if(from > to && to >= 0 && from < sheetNameList.length)
				{
					if(before == true)
					{
						sheetName = new String (sheetNameList[from]);
							for(i = from - 1; i >= to; i--)
							{
								sheetNameList[i+1] = sheetNameList[i];
							}    
						sheetNameList[to] = sheetName;
						output = new String (sheetNameList[to]);
					}else{
						sheetName = new String (sheetNameList[from]);
							for(j = from - 1; j >= indexafterto; j--)
							{
								sheetNameList[j+1] = sheetNameList[j];
							}
						sheetNameList[indexafterto] = sheetName;
						output = new String (sheetName(indexafterto));
					}
				}
			}
			return output;

		}
	}
    
