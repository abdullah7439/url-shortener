<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamMemberRequest;
use App\Mail\InvitationMail;
use App\Repositories\InvitationRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

// Admin only (see the EnsureRole middleware on the route), limited to the Admin's own company.
class TeamController extends Controller
{
    private $users;
    private $invitations;

    public function __construct(UserRepository $users, InvitationRepository $invitations)
    {
        $this->users = $users;
        $this->invitations = $invitations;
    }

    public function index(Request $request)
    {
        $companyId = $this->companyId($request);

        $members = $this->users->getByCompanyWithUrlCount($companyId);
        $pending = $this->invitations->getPendingByCompany($companyId);

        return view('team.index', compact('members', 'pending'));
    }

    public function create(Request $request)
    {
        $this->companyId($request);

        return view('team.create');
    }

    // Invite another Admin or Member into the Admin's own company.
    public function store(StoreTeamMemberRequest $request)
    {
        $companyId = $this->companyId($request);
        $data = $request->validated();

        // The company always comes from the signed-in Admin.
        $invitation = $this->invitations->create([
            'company_id' => $companyId,
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'token' => Str::random(40),
            'invited_by' => $request->user()->id,
        ]);

        Mail::to($invitation->email)->send(new InvitationMail($invitation));

        return redirect()
            ->route('team.index')
            ->with('status', 'Invitation sent to '.$invitation->email.'.')
            ->with('invite_link', $invitation->acceptUrl());
    }

    private function companyId(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_if($companyId === null, 403);

        return $companyId;
    }
}
