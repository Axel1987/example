<?php

namespace App\Http\Controllers\Talent;

use App\Contract\ReviewInterface;
use App\Http\Controllers\Controller;
use App\Service\ReviewService;

class ReviewsController extends Controller
{
    /** @var  ReviewService $reviewService */
    protected $reviewService;

    /**
     * ReviewsController constructor.
     */
    public function __construct()
    {
        $this->reviewService = app()->make(ReviewInterface::class);
    }

    /**
     * @SWG\Get(
     *     tags={"TALENT:: Reviews methods"},
     *     path="/talent/reviews",
     *     summary="Get list of review with pagination",
     *     description="Get list of review with pagination",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="page",
     *          type="integer",
     *          in="query",
     *          required=true,
     *          default="1"
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="Reviews array"
     *     )
     * )
     */
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->reviewService->index();
    }

    
}