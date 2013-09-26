
##CODEFEST 2013
####/*Code Your Way to Smarter World*/
This Application has been developed for CODEFEST 2013.http://codefest.lk/

###The Features of The Application

1. Standard User Management
	1. Create User.
	2. Make User as a Administrator.
	3. User Registration Facility
	4. User Password Reset Facility

2. Tutorial Management
	1. Create Tutorial
	2. Update Tutorial
	3. Delete Tutorial
	4. Attaching a Exam to a Tutorial. Only way to make it available to the users.

3. Exams Management
	1. Dynamically Create MCQ Question Papers from User Input.
	2. Automatically Correcting Exam Questions on Request.(inorder to reduce serverload.)
	3. Storing MCQ Question Data's Permanently for a Re-Correction to be requested by teacher if any mistakes on question paper answers.
	4. Exams cannot be viewed again,only marks viewing is currently supported.

4. Assessment Management
	1. Assessments Can only created by Students from front-end links.
	2. Assessments can be only rated by teachers whom it was submitted to.
	3. Only one Assessment can be submitted for a tutorial at a time.
	4. Exams feature is incorporated in Assessment Management to give easier access.
	5. Marks are automatically given by system via Stored Answers of the Exam on request.
	6. Teacher cannot update marks for a Exam manually.
	7. Teacher can give reviews on Exam Paper done by Student based on marks. Exam paper views are not incorporated into Assessment Pages.

##Prerequisites  
1. Apache 2.2.xx or 2.4.xx
2. PHP 5.4.7 or Greater.(Composer Requires PHP 5.4.7)
3. MySQL 5.6.xx 

#Instructions for Windows PC

1. Clone this repository.
2. Install composer. http://getcomposer.org
3. Go to cloned folder in commandprompt. type -->   composer install
4. Setup a Virtual Host using Virtual Host Manager of EasyPHP.to /public folder
5. Open your browser and go to virtualhost to check everything is fine.


#Instructions for Linux PC / Linux Distros.

1. Install git via your package manager.
2. Install SmartGit/Hg on your PC.
3. Clone the repository to a local folder.
4. Install composer. http://getcomposer.org
5. Open your command line. move to the folder which the repository is cloned.
6. run --> composer install
7. Create a virtualhost pointing to the /public folder of cloned folder.
8. Start apache2 and check.