<?php

namespace App\Service;

use App\Contract\ReviewInterface;
use App\Http\Request\Client\CreateReviewRequest;
use App\Http\Request\Client\EditReviewRequest;
use App\Job;
use App\Rating;
use App\Review;
use App\Role;
use App\User;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ReviewService implements ReviewInterface
{
    /** @var User $user */
    protected $user;

    /**
     * ReviewService constructor.
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Return list of reviews with paginate
     * 
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        $query = Review::with('job', 'client', 'partner.rating');

        switch ($this->user->userRole->role->name) {
            case Role::ROLE_ADMIN:
                break;
            case Role::ROLE_PARTNER:
                $query->whereHas('job', function ($q){
                        $q->where('assigned' , $this->user->id);
                    })
                    ->where('status',true);
                break;
            case Role::ROLE_CLIENT:
                $query->where([
                        'client_id' => $this->user->id,
                        'status' => true
                    ]);
                break;
            default:
                throw new UnprocessableEntityHttpException('Unknown user');
        }

        return $query->orderBy('id')
            ->paginate(10);
    }

    /**
     * Return record of review with Talent and job
     * 
     * @param Review $review
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function view(Review $review)
    {
        return Review::with('partner', 'job')
            ->where([
                'client_id' => $this->user->id,
                'id' => $review->id,
                'status' => true
            ])
            ->first();
    }

    /**
     * Create new review to job
     *
     * @param CreateReviewRequest $request
     * @return ReviewService|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(CreateReviewRequest $request)
    {
        $job = Job::where(['id' => $request->get('job_id')])
            ->first();

        if(!$job->completed){
            throw new UnprocessableEntityHttpException('You can\'t create review to active job');
        }

        if($job->review){
            throw new UnprocessableEntityHttpException('You can\'t create more of one review to one job');
        }

        $review = new Review($request->all());
        $review->save();

        $this->updateRating($review);

        return $this->view($review);
    }

    /**
     * Edit record of review
     * 
     * @param EditReviewRequest $request
     * @param Review $review
     * @return ReviewService|\Illuminate\Database\Eloquent\Model|null
     */
    public function edit(Review $review, EditReviewRequest $request)
    {
        $review->update($request->all());
        $this->updateRating($review);

        return $this->view($review);
    }

    /**
     * Mark review as inactive
     * 
     * @param Review $review
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Review $review)
    {
        $review->update(['status' => false]);
        $this->updateRating($review);
        
        return response('', 204);
    }

    /**
     * Update partner's rating
     *
     * @param Review $review
     */
    protected function updateRating(Review $review)
    {
        $ratingParams = $review->getRatingParams();

        Rating::updateOrCreate([
            'user_id' => $review->partner->id,
            'rating' => ceil($ratingParams->sum/$ratingParams->count)
        ]);
    }
}