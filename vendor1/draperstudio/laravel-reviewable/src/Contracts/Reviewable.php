<?php

/*
 * This file is part of Laravel Reviewable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Reviewable\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface Reviewable.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
interface Reviewable
{
    /**
     * @return mixed
     */
    public function reviews();

    /**
     * @param $data
     * @param Model      $author
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function review($data, Model $author, Model $parent = null);

    /**
     * @param $id
     * @param $data
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function updateReview($id, $data, Model $parent = null);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteReview($id);
}
