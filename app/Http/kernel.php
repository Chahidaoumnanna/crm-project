protected $middlewareGroups = [
    'api' => [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        'throttle:api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
];

<!--protected $routeMiddleware = [-->
<!--'auth' => \App\Http\Middleware\Authenticate::class,-->
<!--// autres middlewares...-->
<!--];-->
<!--kernel-->
