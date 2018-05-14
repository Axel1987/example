<?php

namespace App\Http\Controllers\Client;

use App\Contract\ReviewInterface;
use App\Http\Controllers\Controller;
use App\Http\Request\Client\CreateReviewRequest;
use App\Http\Request\Client\EditReviewRequest;
use App\Review;
use App\Service\ReviewService;

class ReviewController extends Controller
{
    /** @var  ReviewService $reviewService */
    protected $reviewService;

    /**
     * ReviewController constructor.
     */
    public function __construct()
    {
        $this->reviewService = app()->make(ReviewInterface::class);
    }

    /**
     * @SWG\Get(
     *     tags={"CLIENT:: Reviews methods"},
     *     path="/client/reviews",
     *     summary="Get list of client's review with pagination",
     *     description="Get list of client's review with pagination",
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

    /**
     * @SWG\Get(
     *     tags={"CLIENT:: Reviews methods"},
     *     path="/client/reviews/{id}",
     *     summary="View review data",
     *     description="View review data",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="id",
     *          type="integer",
     *          in="path",
     *          required=true
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="Review data"
     *     )
     * )
     */
    /**
     * @param Review $review
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function view(Review $review)
    {
        return $this->reviewService->view($review);
    }

    /**
     * @SWG\Post(
     *     tags={"CLIENT:: Reviews methods"},
     *     path="/client/reviews",
     *     summary="Add new review",
     *     description="Add new revie",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          description="Review's data",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="client_id", type="integer", default="" ),
     *              @SWG\Property(property="talent_id", type="integer", default="" ),
     *              @SWG\Property(property="job_id", type="integer", default="" ),
     *              @SWG\Property(property="rating", type="integer", default="" ),
     *              @SWG\Property(property="text", type="string", default="" ),
     *          ),
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="New review data"
     *     )
     * )
     */
    /**
     * @param CreateReviewRequest $request
     * @return ReviewService|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(CreateReviewRequest $request)
    {
        return $this->reviewService->create($request);
    }

    /**
     * @SWG\Put(
     *     tags={"CLIENT:: Reviews methods"},
     *     path="/client/reviews/{id}",
     *     summary="Edit review",
     *     description="Edit review",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="id",
     *          type="integer",
     *          in="path",
     *          required=true
     *     ),
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          description="Review's data",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="client_id", type="integer", default="" ),
     *              @SWG\Property(property="talent_id", type="integer", default="" ),
     *              @SWG\Property(property="job_id", type="integer", default="" ),
     *              @SWG\Property(property="rating", type="integer", default="" ),
     *              @SWG\Property(property="text", type="string", default="" )
     *          ),
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="Actually review data"
     *     )
     * )
     */
    /**
     * @param Review $review
     * @param EditReviewRequest $request
     * @return ReviewService|\Illuminate\Database\Eloquent\Model|null
     */
    public function edit(Review $review, EditReviewRequest $request)
    {
        return $this->reviewService->edit($review, $request);
    }

    /**
     * @SWG\Delete(
     *     tags={"CLIENT:: Reviews methods"},
     *     path="/client/reviews/{id}",
     *     summary="Delete review",
     *     description="Delete review",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="id",
     *          type="integer",
     *          in="path",
     *          required=true
     *     ),
     *     @SWG\Response(
     *      response="204",
     *      description="Confirm"
     *     )
     * )
     */
    /**
     * @param Review $review
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Review $review)
    {
        return $this->reviewService->delete($review);
    }
}