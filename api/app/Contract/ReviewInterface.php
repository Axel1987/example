<?php

namespace App\Contract;

use App\Http\Request\Client\CreateReviewRequest;
use App\Http\Request\Client\EditReviewRequest;
use App\Review;
use App\Service\ReviewService;

interface ReviewInterface
{
    /**
     * Return list of reviews with paginate
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index();

    /**
     * Return record of review with Talent and job
     *
     * @param Review $review
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function view(Review $review);

    /**
     * Create new review to job
     *
     * @param CreateReviewRequest $request
     * @return ReviewService|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(CreateReviewRequest $request);

    /**
     * Edit record of review
     *
     * @param EditReviewRequest $request
     * @param Review $review
     * @return ReviewService|\Illuminate\Database\Eloquent\Model|null
     */
    public function edit(Review $review, EditReviewRequest $request);

    /**
     * Mark review as inactive
     *
     * @param Review $review
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Review $review);
}