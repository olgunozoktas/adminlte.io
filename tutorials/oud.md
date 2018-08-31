# Online User Detection

1. Create a middleware to cache every authenticated user
2. Add the middleware to the Kernel.php
3. Create a handle function in the middleware
4. Create a custom function in Users.php to check whether the user is online or not
5. Create a route to show online users
6. Its time to see online users :)

Step 1:

To create an middleware, following artisan command is useful and easiest method

```
php artisan make:middleware LastUserActivity
```

Step 2:

Go to the app/Http/Kernel.php to add those lines for to be sure that LastUserActivity middleware is always works on in every route

```
    protected $middlewareGroups = [
        'web' => [
        	....
        	....
            \App\Http\Middleware\LastUserActivity::class,
        ],

        ....
        ....
        ....
    ];
```

Step 3:

Create the handle function in LastUserActivity.php (middleware)

```
Add those required namespaces

	use Auth;
	use Cache;
	use Carbon\Carbon;

	....
	....

    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online-'. Auth::user()->id, true, $expiresAt); //After 2 minutes this cache will be expired
        }
        return $next($request);
    }
```

Explaination: Whenever a request comes to the any route in web.php file, the LasUserActivity middleware will run and it will check if the user is authenticated (logged in) then it will create an cache file in the server according to the user id like "user-is-online-1". Then automatically request continue. After 2 minutes later the cache will be destroyed but if the user sends any other request then another cache file will be created as well.

Step 4:

Create a custom function to return whether the is online or not

```
	Add required namespace

	use Cache;

	....


	//Check if User is online
    public function isOnline(){
        return Cache::has('user-is-online-'. $this->id); //true or false
    }
```

Step 5:

Create a route in web.php to show the online user

```
	Add requires namespace

	use App\User;

	Route::get('users', function(){
	    $users = User::all();
	    return view('users', compact('users'));
	});
```

[users view file](../resources/views/users.blade.php);
