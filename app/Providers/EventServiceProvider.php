protected $listen = [
\Illuminate\Auth\Events\Login::class => [
\App\Listeners\LogStudentLogin::class,
],
\Illuminate\Auth\Events\Logout::class => [
\App\Listeners\LogStudentLogout::class,
],
];