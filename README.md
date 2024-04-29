# HospitalAdminSystem
The Hospital Management System is a comprehensive web-based application designed to streamline the operations of healthcare facilities. The project caters to the administrative needs of hospitals by managing patient information, facilitating doctor registrations, and scheduling appointments. Its user-friendly interface allows for the seamless recording and retrieval of patient details, including personal information, contact numbers, and assigned doctors, improving the efficiency of patient care management. With features like gender-based filtering and the association of patients with registered medical practitioners, the system enhances the functionality and coordination of hospital services. Editing and deleting capabilities ensure that the data remains current and accurate, reflecting the dynamic environment of medical service provision. Overall, this system represents a pivotal step towards digitizing healthcare administration, aiming to optimize patient handling and hospital workflows.


For windows:
First install XAMPP
Install PHP. Go to https://windows.php.net/download#php-8.3 and install VS16 x64 Thread Safe zip file.
Download windows Linux system: do `wsl --install` in cmd prompt to install

After PHP installation
Add php to user systems for windows:
To do so: Uncomment php mysqli extension line in php.ini file saved within php installation in C drive(where you just downloaded it). 
Copy the path of this file and go to System Properties, go to advanced settings, and go to environment variables. Add the path to user variables or system variables. Click edit, click new, add the path to the total php folder. It will look like this C:\php-8.3.6-Win32-vs16-x64.(Saved in my C drive)

To check if mysqli is working, go to cmd prompt, go to cd of the php file we saved. it is in C drive. 
use php -m to check.(it will show you if mysqli is there or not). If it is not there, go to php.ini file in php installation folder in C drive, uncomment mysqli extension line, save it, enter it into the user variables(maybe enter into system variables this time). Save it and run the command in cmd prompt again to check if mysqli is there.


TO START THE PROGRAM/APPLICATION

TO START SERVER
Start XAMPP
Start Apache
Navigate to browser, go to localhost:80 
Go to XAMPP website that comes up and click phpmyadmin on the dashboard
Go back to XAMPP app and start mySQL
Then refresh the xampp website browser
phpmyadmin should start. Here you can access all the databases.

START PROGRAM
To start the program/website.
Open command prompt, cd into your directory that the project is saved in, mine is 
C:\Users\Affan\NewHospital\CS4347PR>cd RegistrationProject 2
Then in cmd prompt, do command `php -S localhost:5502` ; 5502 is the port the localhost is running on (change if needed)
Then use this link to open the website
http://localhost:5502/index.html

