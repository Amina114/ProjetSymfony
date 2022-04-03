# SymfonyProject https://github.com/Amina114/SymfonyProject.git
This project is fullstack symfony4
A project to manage a list of classroom , to effect a student to this classroom and to affect a student to clubs 
This project is composed of 3 parts:
part one manage a classromm
part two manage a student 
part three manage a clubs
To install and run the project, first of all you have to check your connection to your server
than prepare the enviroment using this two ligne of commande 
    composer create-project symfony/website-skeleton your_project_name "4.4.*"
    composer require symfony/web-server-bundle
after that  clone the code (https://github.com/Amina114/SymfonyProject.git) (git clone)
than  excute this query to create your data base
php bin/console doctrine:database:create
than migate all the class and the relation btw the entites using those queries 
php bin/console make:migration
php bin/console doctrine:migrations:migrate
now excute php bin/console server:run to run the project 
For more information you can contact me : chabchoub.amina@esprit.tn or linkedin https://www.linkedin.com/in/amina-chabchoub-9a6800202/ Thanks.
