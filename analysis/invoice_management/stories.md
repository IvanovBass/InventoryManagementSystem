## Stories

**Story 1** As an authenticated user, I want to view my invoices.
		1. The user can select "invoices" from the sidebar menu;
		2. The system displays the invoice list belonging to the user;

	Alternative:
		Admin: if the user is an admin
			 This sequence starts at step 2 of the nominal scenario.
				The system displays the invoice list belonging to all users;

**Story2** As an authenticated user, I want to add an invoice to my list.
		1. The user selects the “add invoice” button on the invoice list page;
		2. The system displays the “Add Invoice” form;
		3. The user selects a date, a category and a product before selecting the “Add More” button;
		4. The system will add and display the chosen product in a list below;
		5. The user enters the required amount of pieces and optionally a description;
		6. The system will automatically update and display the total price per product and for the whole list;
		7. The user selects the “Invoice Store” button;
		8. The system stores the invoice into the database;
		9. The user is sent back to their invoice list;

	Alternative:
		Error: empty mandatory fields and/or invalid username and password
			 This sequence starts at step 4 of the nominal scenario.
			  The system displays (an) error message(s) informing the user of detected errors.
			 The nominal scenario of Story2 resumes at step 1.
		Loop: if the user wants to add more products
			 This sequence starts after step 6 of the nominal scenario.
				Steps 3 through 6 are repeated as often as seen fit.

**Story 3** As an authenticated user, I want to cancel or delete an invoice from my list.
		1. The user selects the trash icon next to the invoice they want to delete;
		2. The system displays a confirmation box;
		3. The user selects the “Yes, delete it!” button;
		4. The system removes all relevant data from the database;
		5. The system updates the invoice list;
		6. The system closes the confirmation box;

	Alternative:
		Cancel: the user changes their mind
			 This sequence starts at step 3 of the nominal scenario.
			  The user selects the “Cancel” button.
			 The nominal scenario of Story3 resumes at step 6.

**Story 4** As an authenticated user, I want to search specific data in my invoice list.
		1. The user selects the search box above the action column;
		2. The user enters the key words;
		3. The system updates the displayed list to match the search;

	Alternative: None

**Story 5** As an authenticated admin, I want to approve pending invoices.
	1. The admin selects the checkmark icon corresponding to the request they want to approve;
	2. The system displays the details of the invoice;
	3. The admin selects the “Invoice Approve” button;
	4. The system removes the products from the stock;
	5. The system returns the admin to the invoice list;

Alternative:
	Already Approved: if the invoice has already been Approved
		 This sequence starts at step 3 of the nominal scenario.
			The system displays the button as "Invoice already approved!".
		 The nominal scenario of Story5 resumes at step 5.
	Lack of stock: if any of the requested products lack in stock
		 This sequence starts at step 3 of the nominal scenario.
			The system displays an error message informing the user of the detected error.
		 The nominal scenario of Story5 resumes at step 2.
	Cancel: the admin changes their mind
		 This sequence starts at step 2 of the nominal scenario.
			The user selects the “Return” button.
		 The nominal scenario of Story5 jumps to step 5.
