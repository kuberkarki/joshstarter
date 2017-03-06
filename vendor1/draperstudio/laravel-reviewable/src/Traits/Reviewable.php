<?php

/*
 * This file is part of Laravel Reviewable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Reviewable\Traits;

use DraperStudio\Reviewable\Models\Review;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reviewable.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
trait Reviewable
{
    /**
     * @return mixed
     */
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    /**
     * @param $data
     * @param Model      $author
     * @param Model|null $parent
     *
     * @return static
     */
    public function createReview($data, Model $author, Model $parent = null)
    {
        return (new Review())->createReview($this, $data, $author);
    }

    /**
     * @param $id
     * @param $data
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function updateReview($id, $data, Model $parent = null)
    {
        return (new Review())->updateReview($id, $data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteReview($id)
    {
        return (new Review())->deleteReview($id);
    }

    /**
     * @return float
     */
    public function getRating()
    {
        return round($this->reviews()->avg('rating'));
    }
}
