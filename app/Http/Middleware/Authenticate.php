<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    protected $owner_route = 'owner.login';
    protected $teacher_route = 'teacher.login';
    protected $student_route = 'student.login';

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Route::is('owner.*')){
                return route($this->owner_route);
            } elseif(Route::is('teacher.*')){
                return route($this->teacher_route);
            } else {
                return route($this->student_route);
            }

        }
    }
}
