<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['client_id', 'talent_id', 'job_id', 'rating', 'text', 'status'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function partner()
    {
        return $this->hasOne(User::class, 'id', 'talent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function job()
    {
        return $this->hasOne(Job::class, 'id', 'job_id');
    }

    /**
     * Get rating params for partner
     *
     * @return mixed
     */
    public function getRatingParams()
    {
        return $this->selectRaw('count(*) as count, sum(rating) as sum')
            ->where([
                'talent_id' => $this->talent_id,
                'status' => true
            ])
            ->first();
    }
}
