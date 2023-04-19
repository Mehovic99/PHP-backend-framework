<p align="center">
  <img src="https://user-images.githubusercontent.com/76923830/232968928-37ab729c-145a-428c-a190-75ffe2b67368.png"/>
</p>

# Welcome to the Usage guide for this Project.
# Laravel - The PHP Framework for web artisans || HulkApps Task

In this document you can find the detailed instructions on how to get the project running on your machine in order to test the features for yourself. Without further delay, let us begin

## Step 1: Opening the project

In the case that you want to clone the project, all you have to do is copy the link provided on the repository of the project. The link is located in the tab shown on the picture below

![step 1](https://user-images.githubusercontent.com/76923830/233051456-b20ad1c7-47ef-4dbf-badb-e3985aec4c32.JPG)

## OR

In the case that you have recieve the project as a winrar, extract the files into a folder. This folder should be located inside of either a xampp localhost or in wamp localhost. After that you can open the folder as a project inside the prefered IDE. In the end the outcome should look like this:

![folder location](https://user-images.githubusercontent.com/76923830/233052873-3242d4d0-4f55-45c7-a7db-e95392e97ea2.JPG)
![step 2](https://user-images.githubusercontent.com/76923830/233051835-d992ec03-cb14-42d0-a203-add74038c745.JPG)

## STEP 2: Running the project

Since the project is using the laravel framework, the project is supposed to be run by a terminal command that goes 

```
php artisan serve
```

However, before that command neeeds to be run, there are files that need to be present. First of all, the file called **_.env_** is supposed to be present. This file defines the local host, the database that it should be connected to and the login credentials in order to reach that database. Now, unless you have the project extracted through a winrar, you shall not recieve the .env file. Instead you shall recieve the .envexample file. This file serves to provide the code required for .env. The reason that .env is missing from the github repository or any version control repository is so that theft of personal data and breaches may be prevented. In the case that you have the .env file, the file content should look something like this

![env](https://user-images.githubusercontent.com/76923830/233055713-9b6646b4-9253-44e5-a8f1-f5c2e800b248.JPG)

The highlighted area is where you input your phpMyAdmin credentials in order to be able to connect to a database. In the situation that you don't have the .env file, then simply create a new file called .env in your project folder and copy everything from thje .envexample file into the newly created .env file. This way you can input your credentials again and move on



Now after all that is done you should run the command called ```php artisan serve```. If you get a result as in the picture below, that means you have successfully ran the project

![artisan serve](https://user-images.githubusercontent.com/76923830/233056571-eeb49c49-7e87-4b37-a5a4-00269ec6980e.JPG)

After which, if you open the given link, it should look something like this

![Capture](https://user-images.githubusercontent.com/76923830/233056732-6a3687da-5153-4fdd-aa82-9637d67e90ba.JPG)

## STEP 3: Database manual input or seeding

Now after ensuring that you have the program running correctly, its time to create the database. Go to PhpMyAdmin.

![php](https://user-images.githubusercontent.com/76923830/233057125-77b4093b-0fc2-4f2f-8817-fabc8403bc49.JPG)

After you open, click on the new icon and create an empty database called according to the .env file specification. In this example, the database is called laravel since in the .env file the database is stated to be called laravel. You should then input the command ```php artisan migrate```. This will populate the database with empty rows provided by laravel at the start. 

### OPTION 1: Manually inputing the database

Now after migrating the data, type in ```php artisan tinker```. This will open a new sub terminal called tinker which will allow you to input dummy data for testing. After which type in ```$post = new App\Models\Post```. This will make the tinker open a new column ready for typing. Now you should input ```$post->title = 'some text'``` and after pressing enter type in ```$post->content = 'some other text'```. After all of that is done, input ```$post->save();```. Now you have beginning data

### OPTION 2: Deploy Seeder to the database

Now for a simpler option, once you have done the empty migration, all you have to do is input the following command and wait ```php artisan migrate:fresh --seed```. This takes the data provided by the seeding and the factories in order to seed the data with artisan faker. After completion, you should have a seeded database

## FINAL STEP: Use Postman to test the routes

Using postman, copy and paste the link given by laravel when running it. Once that is done add at the end /api/posts and you should be good to go


# I hope this was detailed enough to follow. Thank you for your attention and have a good day.
