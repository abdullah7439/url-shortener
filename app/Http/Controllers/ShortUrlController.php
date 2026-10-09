<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortUrlRequest;
use App\Models\ShortUrl;
use App\Repositories\ShortUrlRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ShortUrlController extends Controller
{
    private $shortUrls;

    public function __construct(ShortUrlRepository $shortUrls)
    {
        $this->shortUrls = $shortUrls;
    }

    public function index(Request $request)
    {
        Gate::authorize('viewAny', ShortUrl::class);

        $shortUrls = $this->shortUrls->getVisibleTo($request->user());

        return view('short-urls.index', compact('shortUrls'));
    }

    public function create()
    {
        Gate::authorize('create', ShortUrl::class);

        return view('short-urls.create');
    }

    public function store(StoreShortUrlRequest $request)
    {
        $shortUrl = $this->shortUrls->create($request->user(), $request->validated()['original_url']);

        return redirect()
            ->route('short-urls.index')
            ->with('status', 'Short URL created: '.$shortUrl->short_link);
    }
}
