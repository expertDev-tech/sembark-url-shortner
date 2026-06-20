<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreInvitationRequest;
use App\Models\Invitation;
use App\Services\InvitationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;

class InvitationController extends Controller
{
    use AuthorizesRequests;
    
    public function create()
    {
        $this->authorize('create', Invitation::class);

        return view('invitations.create');
    }

    public function store(StoreInvitationRequest $request,InvitationService $invitationService): RedirectResponse {

        $this->authorize('create', Invitation::class);

        $invitation = $invitationService->create(
            auth()->user(),
            $request->validated()
        );

        Mail::to($invitation->email)
        ->send(new InvitationMail($invitation));

        return redirect()
            ->route('invitations.create')
            ->with('success', 'Invitation created successfully.');
    }
}
