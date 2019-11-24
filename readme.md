## About Todo list API

Todo list API is basic API developed in Laravel 6.5.2 using JWT and PostgreSQL as database to demonstrate RESTful concept. Also I have created the front end to cosume APIs in Laravel itself. I have implemented following functionality in this API:
 - Register/Login user, 
 - Add, Update, List, and Delete todos. 
 This API will act as Backend and can be used for any front end frameworks like AngularJs, VueJs.
 
 ## How to install 
 - Download or clone the project in your working directory from this link: https://github.com/bhattraideb/laravel-todoapp
 - Once got downloaded go to project root directory from terminal and run following cammands to make sure that all dependency is up-to date.:
     - make sure to configure your database in .env file in root directory.
     - 'composer install'
     - 'composer dump-autoload'
     - Make sure, bootstrap/cache and storage/... directories exists and writable in the project as per laravel directory structure. For detail you can check here: https://laravel.com/docs/6.x/structure 
     - Finally run 'php artisan optimize:clear' and 'php artisan migrate' to generate required tables command.
 - I highly recommend to create virtual host, In my case I created "http://todoapi.local/". 
    For creating virtual host on nginx you can check this link: https://linuxize.com/post/how-to-set-up-nginx-server-blocks-on-ubuntu-18-04/ 
    
   - Now go to browser and type http://todoapi.local. It will show laravel default page.
   - If everything is fine now go to browser and type http://todoapi.local/todos. It will show register page. 
        once you register it redirects you to todo lists, you can add, update or delete the existing todos.  
   - If you want to test the API, you can do it with the postman for the links given below.
   
        
## How to implement with front end framework
  To integrate this API with front end framework just call the links:
  I have tested following links and working properly.
        
            1- http://todoapi.local/api/v1/users/register       
            
                Sample Data to pass:
                 {
                    "name": "Test name",
                    "email": "hi@gmail.com",
                    "password": "Admin123",
                }
                
            2- http://todoapi.local/api/v1/users/signin
                
                Sample Data to pass:
                {
                "email":"hi@gmail.com",
                "password":"Admin123",
                }
   
            3- http://todoapi.local/api/v1/users/logout?token=[token_goes_here]
            
            4- http://todoapi.local/api/v1/todos       
                                        
            5- http://todoapi.local/api/v1/todos/add       
                         
                             Sample Data to pass:
                              {
                                 "title": "Test title",
                                 "description": "test description",
                             }
                             
            6- http://todoapi.local/api/v1/todos/update       
                          
                              Sample Data to pass:
                               {
                                  "title": "Test title",
                                  "description": "test description",
                              }
                              
                              
            7- http://todoapi.local/api/v1/todos/delete/{id=1}       
              
            8- http://todoapi.local/api/v1/todos/show/{id=1}

