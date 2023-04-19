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

# FEATURE 2: CONTROLLERS

Controllers are functions that are being created in order to read the information from a request object and after processing the request, the controllers create and return a response object. In this example, there is only one unique controller being used. That controller is the **_PostController_**

The PostController class located inside of the App\Http\Controllers folder has functions that each process a different request, correlating to the different api routes. After the functions are written, the response to these functions is called in the class api.php inside of the \routes folder. An example of the controller working on the get method looks like this

```
class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::query()->paginate(20);
        return Post::all();
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
    
        return Post::create([
            'title' => request('title'),
            'content' => request('content')
        ]);
    }
}
```

And the response is being generated in the api.php file, which looks like this
```
Route::get('/posts', [PostsController::class, 'index'])->middleware('auth:sanctum');

Route::post('/posts', [PostsController::class, 'store'])->middleware('auth:sanctum');
```

# FEATURE 3: API Pagination

API Pagination refers to the ability of the called query results to be ordered in a certain way. Think of it as the SQL command called ```ORDER BY```. This dictates to the project that the results should be presented in a certain fashion. In this example I have used the following command

```$posts = Post::query()->paginate(20);```

What this command does is that it only displays 20 given results at a time. If there are more than 20, a new JSON value called **_meta_** will show to the user that the results have been filtered on multiple pages and what pages are being currently showed

# FEATURE 4: SLUGS

Slugs are unique identifiers being generated from a string and being stored inside of a table in SQL. For example if the title of a book is "The Catcher in the Rye" the slug would be as follows "the-catcher-in-the-rye". What slugification does is that it generates slug by taking a string and removing and spaces in between. Additionally, slugification makes the string case insensitive, meaning that it does not matter whether the word contains an uppercase letter or a lowercase letter, the slug ignore it. The code to process slugs is generated with the following command inside of the Create_Posts_table.php migration.

```
Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug')->unique()->after('title');
            $table->timestamps();
        });
    }
```
The string called slug is responsible here. It makes a unique identifier based on the value of the string called title

# FEATURE 5: Database Migration and Seeding

Database migration refers to the process of migrating data from one or more source databases to one or more target databases. In simpler terms, having the values of one database used in another database. Seeding however refers to the process of automatically generating dummy data for a data set inside of a database. This is used in order to save time on creating dummy data and actually making the data as random as possible, in order to allow a wide range of testing. in this case the migration of the postsDatabase used as an example here is located inside of the file called **_2023_04_19_050315_create_posts_table_**. What this file contains is the basic setup of the database being used, such as how many rows and columns it has and what data type the columns contain. Here is a code snippet for the postsDatabase migration
```
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug')->unique()->after('title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
```

The seeder on the other hand is located in database\seeders and the file is called PostSeeder. In this case, we define how the data will be seeded with **_faker_**. Faker is a tool called by Composer that generates dummy data based on the Faker's library. In the seeding part, we define how many columns of dummy data we want created. In this code snippet below I have specified to faker that I want 10 new columns of dummy data based on the data type provided in the Posts Factory

```
public function run()
    {
        Post::factory()
        ->count(10)
        ->create();
    }
```

The Factory is what allows the seeder to populate the data and is in fact what uses the faker to populate its data. The factory looks like this

```
class PostsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model
     * 
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state
     * 
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'content' => $this->faker->text()
        ];
    }
}
```

# FEATURE 6: Routes

Routes are used in a project in order to present some form of data to a web interface. In this project, the only routes that are being used are the following ones:
| Route Name  |
| ------------- |
| GET Method  |
| POST Method |
| PUT Method  |
| DELETE Method  |

GET - fetched the data from the database
POST - adds new data to the database
PUT - modifies existing data from the database
DELETE - removes exisitng data from the database

The routes code is being used inside of the PostController. This is used in order to save coding space inside of the api.php file and in order to easily edit the code in the future should such an operation be required. The routes are defined as functions in the controller and appear as follows:
```
class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::query()->paginate(20);
        return Post::all();
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
    
        return Post::create([
            'title' => request('title'),
            'content' => request('content')
        ]);
    }

    public function update(Post $post)
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        
        $success = $post->update([
            'title' => request('title'),
            'content' => request('content')
        ]);
    
        return [
            'success' => $success
        ];
    }

    public function remove(Post $post)
    {
        $success = $post->delete();
    return [
        'success' => $success
    ];
    }
}
```
And the api.php routes that call upon the defined functions appear as follows:
```
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostsController::class, 'index'])->middleware('auth:sanctum');

Route::post('/posts', [PostsController::class, 'store'])->middleware('auth:sanctum');

Route::put('/posts/{post}', [PostsController::class, 'update'])->middleware('auth:sanctum');

Route::delete('/posts/{post}', [PostsController::class, 'remove'])->middleware('auth:sanctum');
```
# TESTING RESULTS

In order to make sure to test if the progarm works as intended, the features were tested using POSTMAN. Here are some of the results

## GET METHOD RESULTS WITHOUT AUTHENTICATION KEY

![results 1](https://user-images.githubusercontent.com/76923830/233046463-415f0a4e-4025-4651-9400-503cee46f9f5.JPG)

## GET METHOD RESULTS WITH AUTHENTICATION KEY

![results 2](https://user-images.githubusercontent.com/76923830/233046722-2f24cef8-d9c9-4f2f-af9b-6ce4e8fe602f.JPG)

## POST METHOD RESULTS WITHOUT AUTHENTICATION KEY

![results 3](https://user-images.githubusercontent.com/76923830/233046463-415f0a4e-4025-4651-9400-503cee46f9f5.JPG)

## POST METHOD RESULTS WITH AUTHENTICATION KEY

![results 4](https://user-images.githubusercontent.com/76923830/233047464-065307c9-f848-4b73-8f71-af83a4ea14c6.JPG)

## PUT METHOD RESULTS WITHOUT AUTHENTICATION KEY

![results 5](https://user-images.githubusercontent.com/76923830/233046463-415f0a4e-4025-4651-9400-503cee46f9f5.JPG)

## PUT METHOD RESULTS WITH AUTHENTICATION KEY

![results 6](https://user-images.githubusercontent.com/76923830/233048676-779ce6f4-06ee-4ae2-b174-1085d513594d.JPG)
![proof](https://user-images.githubusercontent.com/76923830/233048753-f9a5e70a-9c8f-4379-86d9-3139d09f680a.JPG)

## DELETE METHOD RESULTS WITHOUT AUTHENTICATION KEY

![results 7](https://user-images.githubusercontent.com/76923830/233046463-415f0a4e-4025-4651-9400-503cee46f9f5.JPG)

## DELETE METHOD RESULTS WITH AUTHENTICATION KEY

![Delete Proof](https://user-images.githubusercontent.com/76923830/233049301-f96d01cc-1eb1-4bb9-b32a-eae7f40855b1.JPG)

# MISSING FEATURES

The only features that I was not able to provide in this version (v 1.0) of the laravel api were the features called Query Filtering and Automatic Database generation.
