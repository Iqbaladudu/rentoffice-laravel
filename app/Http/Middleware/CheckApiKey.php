<?php

    namespace App\Http\Middleware;

    use App\Models\ApiKey;
    use Closure;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;

    class CheckApiKey
    {
        /**
         * Handle an incoming request.
         *
         * @param Closure(Request): (Response) $next
         */
        public function handle(Request $request, Closure $next): Response
        {
            $apiKey = $request->header('X-API-KEY');

            if (!$apiKey || !ApiKey::where("key", $apiKey)->exists()) {
                return response()->json(["message" => "Invalid API key"], Response::HTTP_UNAUTHORIZED);
            }
            return $next($request);
        }
    }
