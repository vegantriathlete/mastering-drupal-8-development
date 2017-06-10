# Welcome to "Mastering Drupal 8 Development"
This repository contains all of the code to run a Drupal 8 site. It is the case study for Packt Publishing's "Mastering Drupal 8 Development" course, authored by Marc Isaacson.

## The 'student comments' in the code
The code samples are meant to represent best practices, including proper DocBlock and code comments. To differentiate comments that are directed towards the student we will use the format:

    /******************************************************************************
     **                                                                          **
     ** This is an example of 'student comments.' These comments will always be  **
     ** flush left, regardless of the indentation of the rest of the code near   **
     ** them.                                                                    **
     **                                                                          **
     ******************************************************************************/

## Using the repository
The repository is organized into branches that correspond to the different sections of the course, occasionally with additional branches within a section. The master branch is from immediately after installing Drupal. The "section-01" branch is a duplicate of the master branch. Within each branch there is a setup directory that contains a .tar.gz of the database and a .tar.gz of the configuration.

As you check out a branch of the repository, you will have the latest version of each file. You do not need to use both of them; you will use one or the other. For instance, if you use the database backup it will capture everyting including the configuration. If you do not want to import the data from the example site then use the configuration file.

When you check out branch "section-{0-9}{0-9}" or branch "section-{0-9}{0-9}-lesson-{0-9}{0-9}" and use either file, you will be prepared to begin that section / lesson. For example, let's say that you checked out branch "section-03-lesson-05." After you use either file you will be ready to start watching Video 03.05. All of the setup prior to the student exercise in Video 03.05 will be complete. If you check out "section-04" and use either file you will be ready to watch Video 04.01. If you use the database backup then you will have all of the content created. If you use only the configuration file then you will have only the content that is already in your database.

The "settings.php" file is included in the repository and will be updated every time you check out a new branch. Make sure to read through the student comments about the trusted host pattern and the database configuration!

You've always got the branches available to you, so feel free to experiment with checking out branches and using the files and it will all make sense!

## Signing in to the site
user: admin  
password: admin

## About Marc
In a prior lifetime, Marc was an AS/400 RPG application developer. He left the programming field entirely in 2001 to pursue other interests, including teach High School Math. Marc first fell in love with Drupal in 2008 when he was playing around with creating websites for his own projects. At the time, he didn't have any intention of returning to the programming field; Drupal was just a tool that helped him to get the job done.

After a series of life events conspired to bring him back to programming, he decided to teach himself to be a web developer. Naturally, he chose Drupal as the tool to learn. Marc started building websites for clients in 2010 and now specializes in using Drupal as a framework to build custom web applications.

Marc has attended and presented at many Drupal camps, including DrupalCamp Colorado, BADCamp, MidCamp, Drupal Camp Utah, Texas Camp and Twin Cities Drupal Camp. He attended DrupalCons in Denver, Portland, Austin, Los Angeles and New Orleans. He was a Core Sprint Mentor in New Orleans.

### Some places you can find Marc online:
* https://www.drupal.org/u/vegantriathlete
* https://www.isaacsonwebdevelopment.com
* https://www.howtobeasuccessfulwebdeveloper.com
* https://www.linkedin.com/in/marceisaacson/
