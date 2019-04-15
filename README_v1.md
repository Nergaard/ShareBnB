# .: ShareBNB - Gruppe 13
This page is dedicated to the setup of ShareBNB offline; for development purposes only. If you want to set up AirBNB on a live server, please check out our wiki.

### Note!
The database is now set up on stud.ntnu.no as standard. This means that as long as you have the NTNU-VPN set up on your computer, you won’t need to set up a local database. (Structural changes should always be implemented in an offline test-environment before its implemented on the live database).

To access the online database, go to: https://mysqladmin.stud.ntnu.no/

**Username:** `toralfto_sharebnb`

**Password:** `800nMoJX`
## Google API Key
API-key: `AIzaSyBSzKJClNckJGM6N3BuOIpDSBTmspo-970`
# .: Setup MAMP / WAMP
## Installation

1.  Download the latest version of MAMP (MAMP & MAMP PRO) from  [www.mamp.info](https://www.mamp.info/).
2.  Double click on the file  `MAMP_MAMP_PRO_***.pkg`  in your Downloads folder.
3.  The System Installer will guide you through the installation process.

**Note: You need administrator permissions to install MAMP!**

*When installing MAMP, an  `/Applications/MAMP PRO`  application will be installed in addition to your  `/Applications/MAMP`  folder. You can ignore this application if you choose not use MAMP PRO.*

## Install - WAMP *(Unfinished)*

## Setup - MAMP
The first time you start MAMP, there is a few things you should check. 
1. Start MAMP (Do not push the "Start Servers" yet)

2. Go to `Preferences`  by pressing `cmd + ,` or by navigating trough the menu. 

3. Head to the `PHP` tab, and make sure that version `7.2.10` is selected. 

4. Navigate to the `Web Server` tab. Here you should choose an appropriate placement for the Document Root folder (www folder) as all project you're using MAMP for has to be located within the www folder. Remember to also take Git in to consideration. My personal preference is: `\Documents\Git\www`.

5. Push `OK`. You can now start the server. 

### Enabling PHP Error Reporting in MAMP (On by default in WAMP)
1. Navigate to  `/Applications/MAMP/conf/php{your-version}`  and open  `php.ini`. If you are unsure which PHP version you are using, then open the preferences within MAMP and check the PHP tab.

2.  Search for `display_errors`  and change the value from  Off  to  On. Just above this, you can also configure which errors you want to be displayed by configuring  `error_reporting`, but it is recommended leaving this to  `E_ALL`  for development environments.

3. Restart your Apache web server by stopping and starting your servers in MAMP.

## Setup - WAMP *(Unfinished)*

# .: Setup Git(Lab)
## Using terminal *(Unfinished)*
## Using GitKraken *(Unfinished)*


# .: Setup ShareBNB
### Pre-requirements
1. Setup a local Apache, MySQL and PHP server (MAMP / WAMP / LAMP etc). 
2. Clone GitLab project
3. Start servers

## Set up database
Navigate to phpMyAdmin by going to: `http://localhost:8888/MAMP/?language=English`, head in to `TOOLS` and `PHPMYADMIN`

### Create user
When standing in the phpMyAdmin-index page, head to the `SQL` tab. If you can see the text `Run SQL query/queries on server “localhost”:`, you're at the right place. 

Past inn the SQL-code:
```SQL
CREATE USER 'sharebnb'@'%' IDENTIFIED WITH mysql_native_password AS  'password';GRANT ALL PRIVILEGES ON  *.*  TO  'sharebnb'@'%' REQUIRE NONE  WITH  GRANT  OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
```
Push The "Go" button. 

### Check user privileges
Navigate to the `User accounts` tab and locate the "sharebnb"-user you just created. 
Under `Global privileges` it should say `ALL PRIVELEGES`. If not: press `Edit privileges`, check the `Check all`-box and press "Go". 

### Create ShareBNB structure
When standing in the phpMyAdmin-index page, push the `New`-button near the top in the blue coulomb to the left. 

Type inn `ShareBNB` in the "Database Name" form window, make sure it says `utf8_general_ci` in the dropdown menu, and press the "Create" button. 

### Import tables
1. Navigate in to the "ShareBNB"-structure by pushing "ShareBNB" in the blue coulomb on the left side of the phpMyAdmin-page.  

2. Go to the "Import" tab and push the "Choose file" button. 

3. Navigate to the project folder and open `\ShareBNB\DB_IMPORT\DB_Full.sql` 

4. Hit "Go" on the bottom of the page. 

# .: View / Open the project
### Pre-requirements
1. Setup a local Apache, MySQL and PHP server (MAMP / WAMP / LAMP etc). 
2. Clone GitLab project
3. Start servers

Open you're a web-browser of you're choosing and type in: `http://localhost:8888/(***/gruppe-13)`
