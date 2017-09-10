Software Engineering Large Practical, Edinburgh University

**Live in action**

[![Project in action](https://img.youtube.com/vi/9hUZTXsLuDc/default.jpg)](https://youtu.be/9hUZTXsLuDc)


**Under the hood**

[![Creation Guide](https://img.youtube.com/vi/894i39gHJUM/default.jpg)](https://youtu.be/894i39gHJUM)


_______________________
-----------------------
-------- OTHER --------
-----------------------
== SETTING UP THE PROJECT
This project is currently private.
- extract Symfony (2.5.6) in your project folder inside localhost; download: http://symfony.com/download
- Clone the repository into this same repository
- Startup PhpStorm, open the local directory generated when cloning

== CONTRIBUTION GUIDELINES
Working in the Symfony Framework:
- Setup Routing, route to specified controllers
- Run logics and server-side scripts to generate output (this includes rendering forms, loading highscores and such)
- Forward output to the html twig templates

Working in Gamemaker:
- Create game (notes below)

Connect Gamemaker File to database for Login and Save scripts:
- Write JS script to extend GML capabilities
- Use Ajax call in JS script to trigger a PHP event which will execute SQL queries in order to interact with the database.
- Connect Gamemaker with the JS file so that it can be used


_______________________
GAMEMAKER, The game-side of the project

Guide: https://www.youtube.com/watch?v=894i39gHJUM&feature=youtu.be

#1 Displaying how GM works
#2 Running the project in the browser (testing)
#3 How to export the project (generate js and required files)
#4 Project source, how to read content without having Gamemaker installed.

Mentioned in the video [0:20], the controller object will load user variables from the database. To do this I will modify the final .js file and replace the hardcoded values with a db-query.
This will be done using an external .js script, which contains an ajax call to a php script. From here the php script will run a SQL query and return the results back to PHP - Ajax - JS.

I will also add a save-progress script which stores the users current data into the database. This can then be loaded again when the user restarts the game.

Since the data is stored in the database, this can also easily be retrieved in the highscores table on the website.
