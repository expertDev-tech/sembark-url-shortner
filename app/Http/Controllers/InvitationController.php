<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreInvitationRequest;
use App\Models\Invitation;
use App\Services\InvitationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InvitationController extends Controller
{
    use AuthorizesRequests;
    
    public function create()
    {
        return view('invitations.create');
    }

    public function store(StoreInvitationRequest $request,InvitationService $invitationService): RedirectResponse {

        $this->authorize('create', Invitation::class);

        $invitationService->create(
            auth()->user(),
            $request->validated()
        );

        return redirect()
            ->route('invitations.create')
            ->with('success', 'Invitation created successfully.');
    }
}
