FOR TEST PURPOSE :

TEST CUSTOMER -
-> email : abcds@gmail.com password : 123456789
-> email : qwerty@gmail.com password : 123456789

TEST ADMIN -
->email : admin@bangubank.com password : adminadmin

ADDITIONAL EGDE CASES EXPLORED -
-> Cant withdraw or transfer if insufficient balance
-> Cant transfer to Self.
-> Cannot transfer if receiver email is invalid
-> Cannot insert negative amount
-> Has to provide Full Name while Registering

------ ASSIGNMENT INSTRUCTION ------
--BANGUBANK--

BanguBank is a simple banking application with features for both 'Admin' and 'Customer' users.

--Admin Features--

- See all transactions made by all users.
- Search and view transactions by a specific user using their email.
- View a list of all registered customers.

--Customer Features--

- Customers can register using their `name`, `email`, and `password`.
- Customers can log in using their registered email and password.
- See a list of all their transactions.
- Deposit money to their account.
- Withdraw money from their account.
- Transfer money to another customer's account by specifying their email address.
- See the current balance of their account.

Note:
Use OOP concepts.
Use 'File' for storage.
You’ll need to use ‘Session’ for the Logged in users functionality.
You must use ‘Composer’ to autoload your files. Also, make sure to use Namespaces.
You must share your Github repo link for this submission.
