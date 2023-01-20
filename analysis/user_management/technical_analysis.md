## Technical aspects

**User must have admin_profile == 1 to access the feature, otherwise it won't show up in the sidebar at he left side of the dashboard**

**A protection against CRUD operations on the users by non-admin users has been implemented and coded so that a basic user (admin_profile == 0) cannot make CRUD operations on users by typing a route URL such as "user/delete/3" for instance, if a user purposely wanted to delete the user at ID "3" in the database**

**Database tables**
		***User table***
