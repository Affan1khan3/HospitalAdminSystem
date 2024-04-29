# HospitalAdminSystem
The Hospital Management System is a comprehensive web-based application designed to streamline the operations of healthcare facilities. The project caters to the administrative needs of hospitals by managing patient information, facilitating doctor registrations, and scheduling appointments. Its user-friendly interface allows for the seamless recording and retrieval of patient details, including personal information, contact numbers, and assigned doctors, improving the efficiency of patient care management. With features like gender-based filtering and the association of patients with registered medical practitioners, the system enhances the functionality and coordination of hospital services. Editing and deleting capabilities ensure that the data remains current and accurate, reflecting the dynamic environment of medical service provision. Overall, this system represents a pivotal step towards digitizing healthcare administration, aiming to optimize patient handling and hospital workflows.


For windows:
First install XAMPP
Install PHP and windows Linux system

After PHP installatoin
Add php to user systems for windows
Uncomment php mysqli extension line in php.ini file saved within php installation in C drive

To check if mysqli is working, go to cmd prompt, go to cd of the php file we saved. it is in C drive. 
use php -m to check.(it will show you if mysqli is there or not). If it is not there, go to php.ini file in php installation folder in C drive, uncomment mysqli extension line.


TO START THE PROGRAM/SITE

START SERVER
Start XAMPP
Start Apache
Navigate to browser, go to localhost:80 
Go to xampp website that comes up and click phpmyadmin
Go back to XAMPP app and start mySQL
Then refresh the xampp website browser
phpmyadmin should start. Here you can access all the databases.

START PROGRAM
To start the program/website.
Open command prompt, cd into C:\Users\Affan\NewHospital\CS4347PR>cd RegistrationProject 2
Then do command php -S localhost:5200 ; That is the port the localhost is running on (change if needed)
Then use this link to open the website
http://localhost:5502/index.html

