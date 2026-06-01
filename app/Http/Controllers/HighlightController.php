<?php

namespace App\Http\Controllers;
use App\Services\HighlightService;
use Illuminate\Http\Request;

class HighlightController extends Controller {
    public function __construct(protected HighlightService $highlightService) {}

    public function store(Request $request) {
        try {
            $profileId = $request->header('X-User-Id');
            $highlight = $this->highlightService->boostProfile($profileId);
            return response()->json($highlight);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
