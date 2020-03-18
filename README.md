# WSERS2

# Given task:
 You are provided with one sql script to create a db and tables for people registering at an online service
 1. Run the createPersons.sql on your db
 2. Open the Signup.php form and create a user
 3. Check if the user you have created is IN the database

 4. Create a Login.php form which will:
    - Provide the user with two input fields (username and password) and a button - login
    - When the user submits the form, it is redirected to itself and:
        - check if the given user is in the database, if its not:
            - display a message: "you are NOT yet registered"
        - if the user exits:
            - check if the password provided in the input MATCHES the database password.
            - if the password do not match:
                - tell the user: " Invalid password"
            - if the password DOES match:
                - display all the user information: "Name, Last name, country... etc" 

