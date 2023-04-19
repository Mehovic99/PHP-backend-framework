<p align="center">
  <img src="https://user-images.githubusercontent.com/76923830/232968928-37ab729c-145a-428c-a190-75ffe2b67368.png"/>
</p>

# NOTE: USAGE INSTRUCTIONS IN SECONDARY README FILE
------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------

# Laravel - The PHP Framework for web artisans || HulkApps Task

## Task Objective
Creation of a backend RESTful API using PHP. Specifically, creating a backend that is fast and secured by some form of authentication, for example Token, Passport, Sanctum or JWT authentication. In addition to the previous requirement, the application should have a database seeder in order to avoid creating the database manually for testing purposes each time tha api is required.

So in short, the following requirements need to be met in order to conclude that the api was developed successfully:
- Database creation
- Database seeding
- Database migrations
- Proof of api working using postman screenshots or explaining postman usage for api
- Routes
- Authentication
- Query Filtration

## TOOLS USED:
|Visual Studio Code|Bitnami Open Source|WAMP Managing Tool PACKAGED by BITNAMI|PhpMyAdmin|Composer|Postman|
|:-:|:-:|:-:|:-:|:-:|:-:|
|<img src="https://user-images.githubusercontent.com/76923830/232976599-f3664623-da87-4699-998e-428358c41f5c.png" width="100">|<img src="https://user-images.githubusercontent.com/76923830/232976663-fade9d0a-f70b-47c5-9c36-54013fa26de8.png" width="100">|<img src="https://user-images.githubusercontent.com/76923830/232976714-c1249126-39e0-4100-98c2-024a839d606e.png" width="100">|<img src="https://user-images.githubusercontent.com/76923830/232976760-a013bba2-094d-4345-a363-eaaeaa3d7267.png" width="100">|<img src="https://user-images.githubusercontent.com/76923830/232976813-8265b645-f407-4517-9169-b149d281c8b5.png" width="100">|<img src="https://user-images.githubusercontent.com/76923830/233024463-94e361e3-552c-4cf9-ae83-e15cbbde7af1.png" width="100">|


## PROGRAMMING LANGUAGE:
|PHP|
|:-:|
|<img src="https://user-images.githubusercontent.com/76923830/232976123-0b69e481-50bb-4407-94e2-9148ecbe3b2a.png" width="200">|

## FRAMEWORK:
|Laravel|
|:-:|
|<img src="https://user-images.githubusercontent.com/76923830/232974917-d376cc16-da7c-42d8-99df-acd777680b55.png" width="200">|

## USING THE FRAMEWORK FOR EASIER CREATION

Since the framework that is being used for this project is Laravel, the task can be very easily created with laravel and composer. The reason for this is that in order to minimize time for the creation of a complex backend with php, where the developer would have to create the connection, database, seeders, migrations and routes, the laravel framework makes it easier to have all the files preloaded into the desired application. Once the files packaged with laravel are loaded, then the editing of the existing files can be done in order to create the requirements for this project.

With that said, it is time to go through the working features of this backend

# FEATURE 1: Authentication Middleware


Now Laravel comes backed with its own brand of authentication, called [Sanctum](https://laravel.com/docs/10.x/sanctum). Essentially, what Laravel's sanctum allows a person to do is it allows for enablinb middleware authentication for any part of the project that a developer wants secured. In this particular instance, the authentication is used for protecting the routes that are used on the api, such as get, post, put and delete. Here is the code snippet that allows for this to work
```
if (Auth::attempt($credentials)){
            $user = Auth::user();

            $adminToken = $user->createToken('admin-token', ['store', 'update', 'remove']);
            $updateToken = $user->createToken('update-token', ['store', 'update']);
            $basicToken = $user->createToken('basic-token');

            return [
                'admin' => $adminToken->plainTextToken,
                'update' => $updateToken->plainTextToken,
                'basic' => $basicToken->plainTextToken
            ];
        }
```

But before this authentication is ran, the program needs to create the credentials, which is where the code snippet below comes into place. What it does is that it creates three different tokens in this case, that vary in power and ability over routes of the project.
```
Route::get('/setup', function(){
    $credentials = [
        'email' => 'admin@admin.com',
        'password' => 'password'
    ];

    if (!Auth::attempt($credentials)){
        $user = new \App\Models\User();

        $user->name = 'Admin';
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);

        $user->save();
```

An example of the generated output after running the command http://127.0.0.1:8000/setup looks like this
```
{"admin":"1|cFaoePzX1zBPQmEIOrqabDikxFXrFoG8Cfcc9YI8","update":"2|3FWXagSE7gqkZbznUW9HSiuv913X65HN6emFJvvD","basic":"3|GMFgLmOLR0wYAbBFInLHVo9z8p3qPKZMcUo1y58Z"}
```

After implementing the line of code that goes ```->middleware('auth:sanctum')``` after each route, the new outcome when trying to fetch the api is as follows

![example 1](https://user-images.githubusercontent.com/76923830/233035828-0fc5a173-3536-49e9-905e-c8e90f467c13.JPG)

However, after inserting on of the tokens as shown in the image and running the program again, the outcome is different. The outcome will look something like this

![example 2](https://user-images.githubusercontent.com/76923830/233036280-5193199d-765a-4038-b9a5-dc1b7acd022e.JPG)

With these examples shown, its time to move onto the second feature.
