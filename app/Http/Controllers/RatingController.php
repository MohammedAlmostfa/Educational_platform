<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Services\RatingService;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\RateRequest\StoreRatingRequest;
use App\Http\Requests\RateRequest\UpdateRatingRequest;

class RatingController extends Controller
{
    /**
     * @var RatingService
     * Service to handle rating logic.
     */
    protected $ratingService;

    /**
     * Inject the RatingService into the controller.
     *
     * @param RatingService $ratingService
     */
    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    /**
     * Store a new rating.
     *
     * @param StoreRatingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRatingRequest $request)
    {
        // Validate request via FormRequest
        $validated = $request->validated();

        // Pass validated data to the service to create the rating
        $result = $this->ratingService->createRating($validated);

        // Return JSON response based on result
        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Update an existing rating.
     *
     * @param UpdateRatingRequest $request
     * @param Rating $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        // Validate request via FormRequest
        $validated = $request->validated();

        // Pass validated data and the rating to the service for update
        $result = $this->ratingService->updateRating($validated, $rating);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Delete a specific rating.
     *
     * @param Rating $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Rating $rating)
    {
        // Authorize the user via Policy before deleting
        $this->authorize('delete', $rating);

        // Pass the rating to the service for deletion
        $result = $this->ratingService->deleteRating($rating);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }
}
