## Stories

**Story 1** As an administrator, I want to create a new user in the database.
		1.	The administrator access the users list by clicking on the « Administrate Users » button in the sidebar ;
		2.	The system displays a page with a list of users and a button called « Add User » ;
		3.	The administrator clicks on the button ;
		4.	The system displays a « New User » form ;
		5.	The administrator enters the user’s name, email, admin profile, profile image and password, and clicks on « Add User » button ;
		6.	The system validates the data ;
		7.	The system create a new entry in the database with the validated data ;
		8.	The system displays the users list and displays a pop-up window informing the admin the success of the action ;

		Alternative :
			Error : empty mandatory fields and/or invalid format
			 This sequence starts at step 5 of the nominal scenario.
			The system displays (an) error message(s) notifying the administrator of detected errors.


**Story 2** As an administrator, I want to edit an existing user in the database.
		1.	The administrator access the users list displayed as a table. Each entry possesses an « update » button symbolized by a pen, which can be clicked to access the « Edit User » form ;
		2. The user fills in the name, admin profile status, email, profile image, and then clicks on "Update User";
		3. If all the data are correctly filled in, the system validates the data and update them;
		4. The system redirects the user to the users list, which is our "administrate users home page" in other words, and displays a notification that the user has been successfully edited;

	Alternative:
		Error: empty mandatory fields and/or invalid username and email
			 This sequence starts at step 3 of the nominal scenario. The system warns the user if there are missing mandatory fields such as name or email, or if those are not filled in correctly.
			The system displays (an) error message(s) informing the user of detected errors.
			 The nominal scenario of Story2 resumes at step 1.

**Story 3** As an administrator, I want to delete a user.
		1.	The administrator access the users list displayed as a table. Each entry possesses a « delete » button symbolized by a bin, which can be clicked to delete a user ;
		2. The administrator then clicks the "delete button" of a user he wants to delete;
		3. If the ID of the user clicked matches an entry in the database, this entry is deleted and the user is removed from the users list;
		4. The system redirects the user to the users list, which will appear emptied of the user deleted, and the system displays a notification that the user has been successfully deleted;

	Alternative:
		Error: empty mandatory fields and/or invalid password
			 This sequence starts at step 3 of the nominal scenario.
			  The system displays (an) error message(s) informing the user of detected errors.
			 The nominal scenario of Story3 resumes at step 1.
