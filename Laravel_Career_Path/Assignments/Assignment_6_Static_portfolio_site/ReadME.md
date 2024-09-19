# MY PORTFOLIO SITE

All sections in every pages are dynamically loaded from JSON files stored in storage/data, except the big paragraph in my-story section on the home page, which will always be static.
I used the filesystem.php disk to load JSON files, which are then passed to the view for dynamic module loading.
The mailing feature in contacts is not functional yet, and also it wasn't in the assignment.
The site is not device responsive yet. I look forward to do that later and publish in a domain.

## HOW TO RUN
* git clone https://github.com/OvyWanKenobi/InteractiveCares_Laravel_Career_Path.git
* cd InteractiveCares_Laravel_Career_Path/Laravel_Career_Path/Assignments/Assignment_6_Static_portfolio_site/portfolio-site
* composer install
* (env is provide as there is no sensitive data there)
* php artisan key:generate
* php artisan serve


#ASSIGNMENT INSTRUCTION -
This week's assignment is to: "Build your static portfolio site using Laravel".
Set up your development environment and Install a fresh Laravel application.
Use Laravel’s Routing, Controller, View to build your static portfolio website
Features

There will be the following pages in your portfolio site:
Home
Work experiences
Projects (Clicking on each project will open a new page with the project details)
Note:
Don’t use Database
Keep your data in JSON files in the 'storage/data' folder and load them before serving the pages
The webpage design is not the priority in this assignment. You can simply copy any HTML template to design the site or 
