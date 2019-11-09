<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$todayDate 	= date('Y-m-d');
$expiryDate = '2019-11-23';
$finalDate  = '2019-11-30';

if(strtotime($todayDate) > strtotime($expiryDate))
{
	echo "<span style='color:red;'><center><h3><br>SYSTEM FAILURE (ERROR) - PLEASE CONTACT ADMIN or ANUJ</br></h3>Mobile : 8000060541 | Email Id : er.anujjaha@gmail.com</center></span>";
}

if(strtotime($todayDate) > strtotime($finalDate))
{
	echo "<span style='color:red;'><center><h3><br>COMPLETE SYSTEM FAILURE (ERROR) - PLEASE CONTACT ADMIN or ANUJ</br></h3>Mobile : 8000060541 | Email Id : er.anujjaha@gmail.com</center></span>";
	die;
}
$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
