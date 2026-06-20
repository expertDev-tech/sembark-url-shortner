<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreShortUrlRequest;
use App\Services\ShortUrlService;
use App\Models\ShortUrl;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShortUrlController extends Controller
{
    use AuthorizesRequests;

    protected ShortUrlService $shortUrlService;

    public function __construct(ShortUrlService $shortUrlService){
        $this->shortUrlService = $shortUrlService;
    }

    public function create()
    {
        $this->authorize('create', ShortUrl::class);

        return view('short-urls.create');
    }

    public function store(StoreShortUrlRequest $request) {
        $this->authorize('create', ShortUrl::class);

        $shortUrl = $this->shortUrlService->create(
            auth()->user(),
            $request->validated()
        );

        return redirect()
            ->route('short-urls.index')
            ->with(
                'success',
                "Short URL created: {$shortUrl->short_code}"
            );
    }

    public function index()
    {
        $this->authorize('viewAny', ShortUrl::class);

        $shortUrls = $this->shortUrlService->list(auth()->user());

        return view(
            'short-urls.index',
            compact('shortUrls')
        );
    }

    public function redirect(string $shortCode)
    {
        $shortUrl = $this->shortUrlService->resolve($shortCode);

        return redirect()->away(
            $shortUrl->original_url
        );
    }
}
