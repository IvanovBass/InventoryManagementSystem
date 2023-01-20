## Stories

**Story 1** As an administrator, I want to create a new products in the database.
		1. The administrator access the products list by clicking on the « products button » in the sidebar ;
		2. The system displays the a page with a list of products and a « add product button » ;
		3. The administrator click on the button ;
		4. The system displays a « add product » form ;
		5. The administrator enters product ‘s name, price, reference, quantity, minimum quantity and a description, select a category and a supplier, then click on « add button » ;
		6. The system validates the data ;
		7. The system create a new entry in the database with the validated data ;
		8. The system displays the product list and displays a pop-up window informing the admin the success of the action ;

  Alternative :
    Error : empty mandatory fields and/or invalid format  
       This sequence starts at step 5 of the nominal scenario.
        The system displays (an) error message(s) informing the user of detected errors.

**Story 2** As an administrator, I want to update an existing product in the database.
		1. The administrator access a list of products displayed as a table. Each entry possess an « update product button » on witch he can click to access an « update product » form ;
		2. The administrator clicks on the button of the desired product ;
		3. The system displays a “ product ” form within which are displayed the product’s data ;
		4. The administrator replace the old data by the new one and click on the « submit button » ;
		5. The system validates the data ;
		6. The system displays the products list and displays a pop-up window informing the administrator the success of the action ;

  Alternative :
    Error : empty mandatory fields and/or invalid format  
       This sequence starts at step 1 of the nominal scenario.
        The system displays (an) error message(s) informing the user of detected errors.

**Story 3** As an administrator, I want to delete a product in the database.
		1. The administrator access a list of products displayed as a table. Each entry possess an « delete product button » on witch he can click on in order to remove the product from the database ;
		2. The system displays a pop-up window asking the administrator to confirm or cancel his choice by displaying two buttons. A « cancel button » and a « confirm button » ;
		3. The administrator confirm his choice by clicking on the « confirm button » ;
		4. The system refreshes the products table and displays a pop-up window informing the administrator the success of the action ;

  Alternative :
    The administrator want to cancel his choice by clicking on the « cancel button »
       This sequence starts at step 2 of the nominal scenario.
       The nominal scenario of Story3 resumes at step 1.

**Story 4** As an administrator, I want to replenish a product quantity in the database.
		1. The administrator click on the « replenish button » in the sidebar ;
		2. The system displays a products list. Each entry possess an « replenish product button » on witch he can click to access an « replenish product » form ;
		3. The administrator clicks on the button of the desired product ;
		4. The system displays a « replenish product » form ;
		5. The administrator entre the number of product to add in the stock ;
		6. The system displays a list of product and displays a pop up window informing the administrator of the success of the action ;

Alternative :
  Error : empty mandatory fields
     This sequence starts at step 4 of the nominal scenario.
      The system displays (an) error message(s) informing the user of detected errors.
