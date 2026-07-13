<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, string $permission)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403);
        }

        // ប្រសិនបើគណនីនេះមានសិទ្ធិធ្វើសកម្មភាពនោះ គឺអនុញ្ញាតឱ្យឆ្លងកាត់
        if ($user->canPerform($permission)) {
            return $next($request);
        }

        // បដិសេធសិទ្ធិបើមិនមានការអនុញ្ញាតពី Owner/Admin
        abort(403, 'លោកអ្នកមិនមានសិទ្ធិចូលប្រើប្រាស់ផ្នែកនេះឡើយ។');
    }
}