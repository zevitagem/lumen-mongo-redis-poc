<?php
declare(strict_types=1);

namespace App\Http\Middleware\Database;

use App\Library\MongoManager;
use Illuminate\Support\Facades\Log;

class MongoMiddleware
{

    public function __construct(MongoManager $databaseManager)
    {
        $this->database = $databaseManager;
    }

    public function handle($request, \Closure $next)
    {
        try {
            $this->database::connect();
            return $next($request);
        } catch (\Throwable $exc) {
            $message = $exc->getMessage();
            Log::info('joseph: '.$message);
        }

        return [
            'code' => -1,
            'data' => [
                'error' => $message,
            ],
        ];
    }
}