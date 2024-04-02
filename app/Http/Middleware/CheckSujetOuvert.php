<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Sujet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CheckSujetOuvert
{   
    USE LivewireAlert;
    public function handle(Request $request, Closure $next)
    {
        $uuid = $request->route('uuid');
        $sujet = Sujet::where('uuid', $uuid)->firstOrFail();
        $studentId = Auth::id();

        // Vérifiez si le sujet a déjà été ouvert par l'étudiant
        $sujetOuvert = DB::table('sujet_openes')
            ->where('sujet_uuid', $sujet->uuid)
            ->where('student_id', $studentId)
            ->first();

        if ($sujetOuvert) {
            // Si le sujet a déjà été ouvert par l'étudiant, redirigez-le vers la page d'accueil
            return redirect()->route('student.panel')->with('status', 'Vous avez déjà ouvert ce sujet.');
        }

        // Sinon, marquez le sujet comme ouvert par l'étudiant
        DB::table('sujet_openes')->insert([
            'sujet_uuid' => $sujet->uuid,
            'student_id' => $studentId,
            'student_ip' => $request->ip(),
            'student_user_agent' => $request->userAgent(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $next($request);
    }
}