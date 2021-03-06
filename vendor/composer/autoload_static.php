<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitea9c3316cbd739af2e660aa5c86710cf
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tests\\' => 6,
        ),
        'M' => 
        array (
            'Modules\\' => 8,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
        'Modules\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Modules',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'AddDummyAdmin' => __DIR__ . '/../..' . '/database/seeds/AddDummyAdmin.php',
        'AddDummyEvent' => __DIR__ . '/../..' . '/database/seeds/AddDummyEvent.php',
        'AddDummyPalestrante' => __DIR__ . '/../..' . '/database/seeds/AddDummyPalestrante.php',
        'AddDummyUser' => __DIR__ . '/../..' . '/database/seeds/AddDummyUser.php',
        'App\\Admin' => __DIR__ . '/../..' . '/app/Admin.php',
        'App\\Console\\Kernel' => __DIR__ . '/../..' . '/app/Console/Kernel.php',
        'App\\Creditor' => __DIR__ . '/../..' . '/app/Creditor.php',
        'App\\Endereco' => __DIR__ . '/../..' . '/app/Endereco.php',
        'App\\Event' => __DIR__ . '/../..' . '/app/Event.php',
        'App\\Exceptions\\Handler' => __DIR__ . '/../..' . '/app/Exceptions/Handler.php',
        'App\\Http\\Controllers\\AdminController' => __DIR__ . '/../..' . '/app/Http/Controllers/AdminController.php',
        'App\\Http\\Controllers\\Auth\\ForgotPasswordController' => __DIR__ . '/../..' . '/app/Http/Controllers/Auth/ForgotPasswordController.php',
        'App\\Http\\Controllers\\Auth\\LoginController' => __DIR__ . '/../..' . '/app/Http/Controllers/Auth/LoginController.php',
        'App\\Http\\Controllers\\Auth\\RegisterController' => __DIR__ . '/../..' . '/app/Http/Controllers/Auth/RegisterController.php',
        'App\\Http\\Controllers\\Auth\\ResetPasswordController' => __DIR__ . '/../..' . '/app/Http/Controllers/Auth/ResetPasswordController.php',
        'App\\Http\\Controllers\\Auth\\VerificationController' => __DIR__ . '/../..' . '/app/Http/Controllers/Auth/VerificationController.php',
        'App\\Http\\Controllers\\AuthenticatorController' => __DIR__ . '/../..' . '/app/Http/Controllers/AuthenticatorController.php',
        'App\\Http\\Controllers\\BoletoController' => __DIR__ . '/../..' . '/app/Http/Controllers/BoletoController.php',
        'App\\Http\\Controllers\\Controller' => __DIR__ . '/../..' . '/app/Http/Controllers/Controller.php',
        'App\\Http\\Controllers\\EventController' => __DIR__ . '/../..' . '/app/Http/Controllers/EventController.php',
        'App\\Http\\Controllers\\HomeController' => __DIR__ . '/../..' . '/app/Http/Controllers/HomeController.php',
        'App\\Http\\Controllers\\InscricaoController' => __DIR__ . '/../..' . '/app/Http/Controllers/InscricaoController.php',
        'App\\Http\\Controllers\\ParticipanteController' => __DIR__ . '/../..' . '/app/Http/Controllers/ParticipanteController.php',
        'App\\Http\\Controllers\\QRController' => __DIR__ . '/../..' . '/app/Http/Controllers/QRController.php',
        'App\\Http\\Controllers\\SendEmailUserController' => __DIR__ . '/../..' . '/app/Http/Controllers/SendEmailUserController.php',
        'App\\Http\\Controllers\\UserController' => __DIR__ . '/../..' . '/app/Http/Controllers/UserController.php',
        'App\\Http\\Kernel' => __DIR__ . '/../..' . '/app/Http/Kernel.php',
        'App\\Http\\Middleware\\Authenticate' => __DIR__ . '/../..' . '/app/Http/Middleware/Authenticate.php',
        'App\\Http\\Middleware\\CheckForMaintenanceMode' => __DIR__ . '/../..' . '/app/Http/Middleware/CheckForMaintenanceMode.php',
        'App\\Http\\Middleware\\EncryptCookies' => __DIR__ . '/../..' . '/app/Http/Middleware/EncryptCookies.php',
        'App\\Http\\Middleware\\RedirectIfAuthenticated' => __DIR__ . '/../..' . '/app/Http/Middleware/RedirectIfAuthenticated.php',
        'App\\Http\\Middleware\\TrimStrings' => __DIR__ . '/../..' . '/app/Http/Middleware/TrimStrings.php',
        'App\\Http\\Middleware\\TrustProxies' => __DIR__ . '/../..' . '/app/Http/Middleware/TrustProxies.php',
        'App\\Http\\Middleware\\VerifyCsrfToken' => __DIR__ . '/../..' . '/app/Http/Middleware/VerifyCsrfToken.php',
        'App\\Inscricao' => __DIR__ . '/../..' . '/app/Inscricao.php',
        'App\\Mail\\SendEmailUser' => __DIR__ . '/../..' . '/app/Mail/SendEmailUser.php',
        'App\\Oficinas' => __DIR__ . '/../..' . '/app/Oficinas.php',
        'App\\Palestra' => __DIR__ . '/../..' . '/app/Palestra.php',
        'App\\Palestrante' => __DIR__ . '/../..' . '/app/Palestrante.php',
        'App\\Participante' => __DIR__ . '/../..' . '/app/Participante.php',
        'App\\Providers\\AppServiceProvider' => __DIR__ . '/../..' . '/app/Providers/AppServiceProvider.php',
        'App\\Providers\\AuthServiceProvider' => __DIR__ . '/../..' . '/app/Providers/AuthServiceProvider.php',
        'App\\Providers\\BroadcastServiceProvider' => __DIR__ . '/../..' . '/app/Providers/BroadcastServiceProvider.php',
        'App\\Providers\\EventServiceProvider' => __DIR__ . '/../..' . '/app/Providers/EventServiceProvider.php',
        'App\\Providers\\RouteServiceProvider' => __DIR__ . '/../..' . '/app/Providers/RouteServiceProvider.php',
        'App\\Role' => __DIR__ . '/../..' . '/app/Role.php',
        'App\\User' => __DIR__ . '/../..' . '/app/User.php',
        'DatabaseSeeder' => __DIR__ . '/../..' . '/database/seeds/DatabaseSeeder.php',
        'Tests\\CreatesApplication' => __DIR__ . '/../..' . '/tests/CreatesApplication.php',
        'Tests\\Feature\\ExampleTest' => __DIR__ . '/../..' . '/tests/Feature/ExampleTest.php',
        'Tests\\TestCase' => __DIR__ . '/../..' . '/tests/TestCase.php',
        'Tests\\Unit\\ExampleTest' => __DIR__ . '/../..' . '/tests/Unit/ExampleTest.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitea9c3316cbd739af2e660aa5c86710cf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitea9c3316cbd739af2e660aa5c86710cf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitea9c3316cbd739af2e660aa5c86710cf::$classMap;

        }, null, ClassLoader::class);
    }
}
