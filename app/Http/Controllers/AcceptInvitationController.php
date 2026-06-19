<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AcceptInvitationRequest;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AcceptInvitationController extends Controller
{
    public function show(string $token)
    {
        $invitation = Invitation::where('token', $token)
            ->firstOrFail();

        if ($invitation->accepted_at) {
            abort(403, 'Invitation already accepted.');
        }

        if ($invitation->expires_at->isPast()) {
            abort(403, 'Invitation expired.');
        }

        return view('invitations.accept', compact('invitation'));
    }

    public function store(AcceptInvitationRequest $request,string $token)
    {
        $invitation = Invitation::where('token', $token)
            ->firstOrFail();

        if ($invitation->accepted_at) {
            abort(403, 'Invitation already accepted.');
        }

        if ($invitation->expires_at->isPast()) {
            abort(403, 'Invitation expired.');
        }

        DB::transaction(function () use ($request, $invitation) {

            $user = User::create([
                'name' => $request->name,
                'email' => $invitation->email,
                'password' => Hash::make($request->password),
                'company_id' => $invitation->company_id,
            ]);

            $user->assignRole($invitation->role);

            $invitation->update([
                'accepted_at' => now(),
            ]);

            Auth::login($user);
        });

        return redirect()->route('dashboard');
    }
}
