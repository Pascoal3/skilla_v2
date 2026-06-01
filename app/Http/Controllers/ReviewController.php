<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller {
    protected $reviewService;

    public function __construct(ReviewService $reviewService) {
        $this->reviewService = $reviewService;
    }

    public function store(Request $request) {
        try {
            $reviewerId = $request->header('X-User-Id');
            $review = $this->reviewService->createReview($request->all(), $reviewerId);
            return response()->json(['message' => 'Avaliação registrada!', 'review' => $review], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}