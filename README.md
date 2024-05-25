Hello and Welcome to our project for Information Security

We are Group 17 and half of our team members are working daily on this project to ensure that the world is secure.

Our approach includes trying to get the user into a safe environment before they start to vote. When th euser is securly connected to the website we make sure that his info is immediatly destroyed, those that exist on the server are the ones who did not vote, and the ones that are not there already voted.

The names passwords and information on the user is stored with a salt and encryption of AES or Eliptic Curve Cryptography, each user's hash is randomly generated by their application or browser and immediatly destroyed before it gets out (for replay prevention). 

If the user does not exist on the server then they already voted.

In this case we wil seperate the user side from the admin side, the admin side will be capable of seeing the number of users that got dropped from the server with a counter and the vote ammount a person received.

As for the secrecy of the information to whom the people voted for, the counter for the minister goes up by one and the name is not saved.


Setup your database:
- We will have a database SQL file that you can insert into your phpmyadmin to startup the database with already existing people and candidates.
Go to file: setup.sql to setup your server, for us we will be using mysql as it is the default server for php my admin.

MySQL has a depreciated MD5 encoding so we will be setting up using a newer AES 128 or ECC, we will be using ECC since its harder to crash the ECC code.


To start:
create a new database: Upler  (we chose a random name so that people wont go by using texbook names to try to SQL inject)


We have table names: 
- Bohemian
and
- Yondora
For these names its best to guess which one is which and you'll see why later

Check the ER Diagram here in root folder under name: Octahedral_ChatGPTimg.png


Rectangles: Entity - Tables

Circles: Values - Variables - etc.

Rhumbus: Relation (Ex: Many Bohemians Poke Yondora, One Yondora can be poked by many Bohemians).

1-m : One to many relationship

The relation is also its own table, but in this case it does not contain anything since the Bohemian gets destroyed.



Additional Questions:

- What if you voted by mistake?
    Welp we make sure you wanted to vote to that candidate before you vote its a 3 step process to ensure that you actually want to vote for them, if that fails for you or your Dog, Cat or a neighbor voted on your behalf its easy to email, the info for you is saved on the browser incase you voted by mistake, it gets destroyed when you leave the browser. 

    On second hand as well, we made sure you were in a safe environment away from your dogs cats and neighbors, soo part of it is your fault as well.

- What if someone takes your device and votes for you?
    Well that is impossible, you have to 2FA your account with itsme, make sure your phone is with you the entire time during this day to do so and not to be sabotaged.

- What if you have a mouse tracker and a virus on your laptop already?
    It's an interesting question because they could be some key loggers and mouse trackers as a virus and you could probably receive these two months or one year beofre the election by email as a malicious email and you downloaded it by mistake, this is defenitly an invasion of privacy and it is not allowed, but the most that would get out if someone knows the position of the candidates on the screen and they can estimate the pixel values, etc.. this means they know who you voted for more or less. We can probably randomize the location of the candidates on the screen per person, but that would mean one person would have the same screen as another and it is inevitable.

    Say: 11.69 million people in Belgium (2022) of which 11.03 million have acess to wifi, and say 70 candidates for 2024, without raplcaement the same person cannot be in the same box as the previous 70 factorial is the answer and it is possible:
    11978571669969891796
    07278372168909873645
    89381425464258575553
    62864628009582789845
    31968000000000000000
    0. Yes its alot of numbers, so yes it is possible to randomize the selection.