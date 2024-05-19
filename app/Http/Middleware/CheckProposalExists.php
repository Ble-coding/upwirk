<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Emploi;

class CheckProposalExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $jobId = $request->emploi->id;

        // if (auth()->user()->proposals->contains('emploi_id', $jobId)) {
        //     return redirect()->route('jobs.index');
        // }

        // return $next($request);


        // $jobId = $request->route('emploi');

        // if (auth()->user()->proposals->contains('emploi_id', $jobId)) {
        //     return redirect()->route('jobs.index');
        // }

        // return $next($request);

        $jobId = $request->route('emploi')->id;

        if (auth()->user()->proposals->contains('emploi_id', $jobId)) {
            return redirect()->route('jobs.index');
        }

        return $next($request);

    }

    // public function handle(Request $request, Closure $next)
    // {
    //     $jobId = $request->route('jobId');

    //     if (!Emploi::find($jobId)) {
    //         return redirect()->route('jobs.index');
    //     }

    //     return $next($request);
    // }
}
