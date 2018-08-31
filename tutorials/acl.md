## ACL (Access Control List) -> To Determine If User is Able To Do That

1. Add a new field to the users table "user_type"
2. Create Gates for the user_type
3. Check if the user_type is acceptable for the request
4. Optional If you want to show some html tags to authorized people add @can('user_type') attribute
5. Go to the Request

Step 1:

Add those lines to the create_users_table.php migration file

```
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('user_type',50)->default('user'); //max 50 characters - default value user
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
```

Step 2:

Go to the app/AuthServiceProvider.php
Add those lines to the boot() function

```
    public function boot()
    {
        $this->registerPolicies();

        //this is the name of the policy it could be anything
        //if the db user has a user_type admin
        //will return true
        Gate::define('isAdmin', function($user){
            return $user->user_type == 'admin';
        });

        Gate::define('isAuthor', function($user){
            return $user->user_type == 'author';
        });

        Gate::define('isUser', function($user){
            return $user->user_type == 'user';
        });
    }
```

Step 3:

Go to the your desired controlller and add those lines to check if the request is came from acceptable user
Add those lines to the index() function or whatever function you want to protect the route

Ex: I will choose the CategoryController's index function to protected it for unouthorized requests

```
    public function index()
    {
        //
        if(!Gate::allows('isAdmin')){
            abort(404,"Sorry, You can do this actions");
        }

        $categories = Category::all();
        return view('category.index', compact('categories'));
    }
```

Step 4:

I would like to not show some fields in my admin dashboard to users who are not admin

```
        @can('isAdmin')
        <li class="active"><a href="{{ url('category') }}"><i class="fa fa-link"></i> <span>Category</span></a></li>
        <li><a href="{{url('users')}}"><i class="fa fa-users"></i> <span>Users</span></a></li>
        @endcan
```

Step 5: App will check all those and will go to the request

1. Add a new field to the users table "user_type"
2. Create Gates for the user_type
3. Check if the user_type is acceptable for the request
4. Optional If you want to show some html tags to authorized people add @can('user_type') attribute
5. Go to the Request

Step 1:

Add those lines to the create_users_table.php migration file

```
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('user_type',50)->default('user'); //max 50 characters - default value user
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
```

Step 2:

Go to the app/AuthServiceProvider.php
Add those lines to the boot() function

```
    public function boot()
    {
        $this->registerPolicies();

        //this is the name of the policy it could be anything
        //if the db user has a user_type admin
        //will return true
        Gate::define('isAdmin', function($user){
            return $user->user_type == 'admin';
        });

        Gate::define('isAuthor', function($user){
            return $user->user_type == 'author';
        });

        Gate::define('isUser', function($user){
            return $user->user_type == 'user';
        });
    }
```

Step 3:

Go to the your desired controlller and add those lines to check if the request is came from acceptable user
Add those lines to the index() function or whatever function you want to protect the route

Ex: I will choose the CategoryController's index function to protected it for unouthorized requests

```
    public function index()
    {
        //
        if(!Gate::allows('isAdmin')){
            abort(404,"Sorry, You can do this actions");
        }

        $categories = Category::all();
        return view('category.index', compact('categories'));
    }
```

Step 4:

I would like to not show some fields in my admin dashboard to users who are not admin

```
        @can('isAdmin')
        <li class="active"><a href="{{ url('category') }}"><i class="fa fa-link"></i> <span>Category</span></a></li>
        <li><a href="{{url('users')}}"><i class="fa fa-users"></i> <span>Users</span></a></li>
        @endcan
```

Step 5: App will check all those and will go to the request
