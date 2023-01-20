## Stories

**Story 1** As an administrator, I want to create a new category in the database.
		1. The administrator access the category list by clicking on the « categories button » in the sidebar ;
		2. The system displays the a page with a list of category and a « add category button » ;
		3. The administrator click on the button ;
		4. The system displays a « add category » form ;
		5. The administrator enters category’s name then click on « add button » ;
		6. The system validates the data ;
		7. The system create a new entry in the database with the validated data ;
		8. The system displays the category list and displays a pop-up window informing the admin the success of the action ;

Alternative :
  Error : empty mandatory fields
     This sequence starts at step 5 of the nominal scenario.
      The system displays (an) error message(s) informing the user of detected errors.

**Story 2** As an administrator, I want to update an existing category in the database.
		1. The administrator access a list of categories displayed as a table. Each entry possess an « update category button » on witch he can click to access an « update category » form ;
		2. The administrator clicks on the button of the desired category ;
		3. The system displays a “ category ” form within which are displayed the category’s data ;
		4. The administrator replace the old data by the new one and click on the « submit button » ;
		5. The system validates the data ;
		6. The system displays the categories list and displays a pop-up window informing the administrator the success of the action ;

Alternative :
  Error : empty mandatory fields
     This sequence starts at step 3 of the nominal scenario.
      The system displays (an) error message(s) informing the user of detected errors.



**Story 3** As an administrator, I want to delete a category in the database.
		1. The administrator access a list of categories displayed as a table. Each entry possess an « delete category button » on witch he can click on in order to remove the category from the database ;
		2. The system displays a pop-up window asking the administrator to confirm or cancel his choice by displaying two buttons. A « cancel button » and a « confirm button » ;
		3. The administrator confirm his choice by clicking on the « confirm button » ;
		4. The system refreshes the categories table and displays a pop-up window informing the administrator the success of the action ;

Alternative :
  The administrator wants to cancel his choice by clicking on the « cancel button »
     This sequence starts at step 2 of the nominal scenario.
     The nominal scenario of Story3 resumes at step 1.

**Story 3** As an administrator, I want to delete a supplier in the database.
    1. The administrator accesses a list of suppliers displayed in a table. Each entry possesses a « delete supplier » button on which he can click on in order to remove the supplier from the database ;
    2. The system displays a pop-up window asking the administrator to confirm or cancel his choice by displaying two buttons. A « cancel » button and a « confirm » button ;
    3. The administrator confirms his choice by clicking on the « confirm » button ;
    4. The system refreshes the suppliers table and displays a pop-up window informing the administrator of the success of the action ;

  Alternative :
    The administrator wants to cancel his choice by clicking on the « cancel button »
       This sequence starts at step 2 of the nominal scenario.
       The nominal scenario of Story3 resumes at step 1.
