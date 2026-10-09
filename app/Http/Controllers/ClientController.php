<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Mail\InvitationMail;
use App\Models\User;
use App\Repositories\CompanyRepository;
use App\Repositories\InvitationRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

// SuperAdmin only (see the EnsureRole middleware on the route).
class ClientController extends Controller
{
    private $companies;
    private $invitations;

    public function __construct(CompanyRepository $companies, InvitationRepository $invitations)
    {
        $this->companies = $companies;
        $this->invitations = $invitations;
    }

    public function index()
    {
        $companies = $this->companies->getAllWithCounts();

        return view('clients.index', compact('companies'));
    }

    public function create()
    {
        return view('clients.create');
    }

    // Invite an Admin into a brand new company.
    public function store(StoreClientRequest $request)
    {
        $data = $request->validated();

        $invitation = DB::transaction(function () use ($data, $request) {
            $company = $this->companies->create($data['company_name'], $data['email']);

            return $this->invitations->create([
                'company_id' => $company->id,
                'email' => $data['email'],
                'role' => User::ROLE_ADMIN,
                'token' => Str::random(40),
                'invited_by' => $request->user()->id,
            ]);
        });

        Mail::to($invitation->email)->send(new InvitationMail($invitation));

        return redirect()
            ->route('clients.index')
            ->with('status', 'Invitation sent to '.$invitation->email.' for the new company "'.$data['company_name'].'".')
            ->with('invite_link', $invitation->acceptUrl());
    }
}
