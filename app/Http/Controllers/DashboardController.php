<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use App\Repositories\ShortUrlRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $shortUrls;
    private $companies;
    private $users;

    public function __construct(ShortUrlRepository $shortUrls, CompanyRepository $companies, UserRepository $users)
    {
        $this->shortUrls = $shortUrls;
        $this->companies = $companies;
        $this->users = $users;
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $shortUrls = $this->shortUrls->getVisibleTo($user);

        // SuperAdmin sees all clients, Admin sees the members of their own company.
        $clients = $user->isSuperAdmin() ? $this->companies->getAllWithCounts() : [];
        $teamMembers = $user->isAdmin() ? $this->users->getByCompanyWithUrlCount($user->company_id) : [];

        return view('dashboard', compact('user', 'shortUrls', 'clients', 'teamMembers'));
    }
}
