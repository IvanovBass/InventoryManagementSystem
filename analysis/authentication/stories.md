## Stories

**Story 1** As a new user, I want to register by creating a username and password so that the system can remember me and log me in.
		1. The user accesses the web platform (login page) where he can select the option “create an account”;
		2. The system displays the “register” form;
		3. The user enters his username, email and a password which they will need to confirm;
		4. The system validates the validity of the data;
		5. The system assigns the "user" profile to the logged-in person;
		6. The system sends an email to the user so that he can confirm his email address;
		7. After the email address is confirmed, the system displays the home page (dashboard);

	Alternative:
	Error: empty mandatory fields and/or invalid username and password
		 This sequence starts at step 4 of the nominal scenario.
		  The system displays (an) error message(s) informing the user of detected errors.
		 The nominal scenario of Story1 resumes at step 2.

**Story 2** As a registered user, I want to log in with my email and password so that the system can authenticate me.
		1. The user accesses the web platform (Sign in page) where they can authenticate;
		2. The user enters their email and password;
		3. The system verifies the existence and validity of the data;
		4. The system identifies the user profile (administrator or user);
		5. The system displays the home page (dashboard);

	Alternative:
		Error: empty mandatory fields and/or invalid username and password
			 This sequence starts at step 4 of the nominal scenario.
			  The system displays (an) error message(s) informing the user of detected errors.
			 The nominal scenario of Story2 resumes at step 1.

**Story 3** As a registered user, I want to be able to change my password.
		1. The user accesses the "change password" page/form;
		3. The user enters their old password, their new password and confirm it;
		4. The system verifies the existence and validity of the data;
		5. The system modifies the password of the user;
		6. The system displays the home page (dashboard);

	Alternative:
		Error: empty mandatory fields and/or invalid password
			 This sequence starts at step 3 of the nominal scenario.
			  The system displays (an) error message(s) informing the user of detected errors.
			 The nominal scenario of Story3 resumes at step 1.

**Story 4** As a registered user, I want to be able to request a new password so that I don't permanently lose access to the platform if I forget my password.
		1. The user accesses the web platform (login page) where they can select the option “Forgot your password?”;
		2. The system displays the “Reset Password” form;
		3. The user enters their username;
		4. The system checks whether the email address exists in the database;
		6. The system sends an email to the user so that they can confirm their email address;
		7. After the email address is confirmed, the system displays the home page (dashboard);

	Alternative:
		Error: empty mandatory fields and/or invalid password
			 This sequence starts at step 4 of the nominal scenario.
			  The system displays an error message if the address does not include '@'.
			  The system does not send any email for confirmation if the email address is not in the database.
			 The nominal scenario of Story4 resumes at step 1.
