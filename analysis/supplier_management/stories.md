## Stories

**Story 1** As an administrator, I want to create a new supplier in the database.
    1. The administrator accesses the suppliers list by clicking on the « suppliers button » in the sidebar ;
    2. The system displays the a page with a list of suppliers and an « add suppliers » button ;
    3. The administrator clicks on the button ;
    4. The system displays an « add supplier » form ;
    5. The administrator enters the supplier’s name, phone, email and then clicks on the « add » button;
    6. The system validates the data ;
    7. The system creates a new entry in the database with the validated data ;
    8. The system displays the suppliers list and displays a pop-up window informing the admin of the success of the action ;

	Alternative :
  Error : empty mandatory fields and/or invalid format  
     This sequence starts at step 5 of the nominal scenario.
    	The system displays (an) error message(s) informing the user of detected errors.

**Story 2** As an administrator, I want to update an existing supplier in the database.
    1. The administrator accesses a list of suppliers displayed in a table. Each entry possesses an « update supplier » button on which he can click on to access an « update supplier » form ;
    2. The administrator clicks on the update button of the desired supplier ;
    3. The system displays a “supplier” form and the supplier’s data ;
    4. The administrator replaces the old data by the new one and clicks on the « submit » button ;
    5. The system validates the data ;
    6. The system displays the suppliers list and displays a pop-up window informing the administrator the success of the action ;

  Alternative :
	  Error : empty mandatory fields and/or invalid format  
	     This sequence starts at step 3 of the nominal scenario.
	      The system displays (an) error message(s) informing the user of detected errors.

**Story 3** As an administrator, I want to delete a supplier in the database.
    1. The administrator accesses a list of suppliers displayed in a table. Each entry possesses a « delete supplier » button on which he can click on in order to remove the supplier from the database ;
    2. The system displays a pop-up window asking the administrator to confirm or cancel his choice by displaying two buttons. A « cancel » button and a « confirm » button ;
    3. The administrator confirms his choice by clicking on the « confirm » button ;
    4. The system refreshes the suppliers table and displays a pop-up window informing the administrator of the success of the action ;

  Alternative :
    The administrator wants to cancel his choice by clicking on the « cancel button »
       This sequence starts at step 2 of the nominal scenario.
       The nominal scenario of Story3 resumes at step 1.
