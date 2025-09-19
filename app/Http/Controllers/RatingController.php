<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Services\RatingService;
use App\Http\Requests\RateRequest\StoreRatingRequest;
use App\Http\Requests\RateRequest\UpdateRatingRequest;

class RatingController extends Controller
{
    protected $ratingService;

    /**
     * Inject the RatingService to handle rating logic.
     */
    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    /**
     * Store a newly created rating in storage.
     */
    public function store(StoreRatingRequest $request)
    {
        $validated = $request->validated();
        $result = $this->ratingService->createRating($validated);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Update an existing rating.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $validated = $request->validated();
        $result = $this->ratingService->updateRating($validated, $rating);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Remove a specific rating.
     */
    public function destroy(Rating $rating)
    {
        $result = $this->ratingService->deleteRating($rating);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }
}
