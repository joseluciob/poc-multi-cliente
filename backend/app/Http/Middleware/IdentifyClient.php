<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IdentifyClient
{
    public function handle($request, Closure $next)
    {
        $applicationId = $request->header('X-Application-ID');

        if ($applicationId) {
            $this->setDynamicDatabaseConnection($applicationId);
        }

        return $next($request);
    }

    private function setDynamicDatabaseConnection($applicationId): void
    {
        $connectionName = 'tenant_' . $applicationId;

        Config::set('database.connections.' . $connectionName, [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'database' => 'db_' . $applicationId,
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]);

        DB::setDefaultConnection($connectionName);
    }
}
