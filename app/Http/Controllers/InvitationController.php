<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcceptInvitationRequest;
use App\Repositories\InvitationRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvitationController extends Controller
{
    private $invitations;
    private $users;

    public function __construct(InvitationRepository $invitations, UserRepository $users)
    {
        $this->invitations = $invitations;
        $this->users = $users;
    }

    // Page the invited person opens from the invitation link.
    public function show(string $token)
    {
        $invitation = $this->invitations->findPendingByTokenOrFail($token);

        return view('invitations.accept', compact('invitation'));
    }

    // Create the user with the invited role and company, then log them in.
    public function accept(AcceptInvitationRequest $request, string $token)
    {
        $invitation = $this->invitations->findPendingByTokenOrFail($token);
        $data = $request->validated();

        if ($this->users->emailExists($invitation->email)) {
            return back()->withErrors(['email' => 'An account with this email already exists.']);
        }

        $user = DB::transaction(function () use ($invitation, $data) {
            $user = $this->users->create([
                'name' => $data['name'],
                'email' => $invitation->email,
                'password' => $data['password'], // hashed by the model cast
                'role' => $invitation->role,
                'company_id' => $invitation->company_id,
            ]);

            $user->forceFill(['email_verified_at' => now()])->save();

            $this->invitations->markAsAccepted($invitation);

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
}
