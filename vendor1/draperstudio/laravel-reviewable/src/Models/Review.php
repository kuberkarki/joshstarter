<?php

/*
 * This file is part of Laravel Reviewable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Reviewable\Models;

use DraperStudio\Database\Traits\Models\PresentableTrait;
use DraperStudio\Reviewable\Presenters\ReviewPresenter;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class Review extends Model
{
    use PresentableTrait;

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reviewable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function author()
    {
        return $this->morphTo('author');
    }

    /**
     * @param Model $reviewable
     * @param $data
     * @param Model $author
     *
     * @return static
     */
    public function createReview(Model $reviewable, $data, Model $author)
    {
        $review = new static();
        $review->fill(array_merge($data, [
            'author_id' => $author->id,
            'author_type' => get_class($author),
        ]));

        $reviewable->reviews()->save($review);

        return $review;
    }

    /**
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    public function updateReview($id, $data)
    {
        $review = static::find($id);
        $review->update($data);

        return $review;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteReview($id)
    {
        return static::find($id)->delete();
    }

    /**
     * @return mixed
     */
    public function getPresenterClass()
    {
        return ReviewPresenter::class;
    }
}
