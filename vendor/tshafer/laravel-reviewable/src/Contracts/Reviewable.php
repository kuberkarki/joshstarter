<?php

    namespace Tshafer\Reviewable\Contracts;

    use Illuminate\Database\Eloquent\Model;


    /**
     * Interface Reviewable
     *
     * @package Tshafer\Reviewable\Contracts
     */
    interface Reviewable
    {

        /**
         * @return \Illuminate\Database\Eloquent\Relations\MorphMany
         */
        public function reviews();

        /**
         * @param            $data
         * @param Model      $author
         * @param Model|null $parent
         *
         * @return mixed
         */
        public function review( $data, Model $author, Model $parent = null );

        /**
         * @param            $id
         * @param            $data
         * @param Model|null $parent
         *
         * @return mixed
         */
        public function updateReview( $id, $data, Model $parent = null );

        /**
         * @param $id
         *
         * @return mixed
         */
        public function deleteReview( $id );
    }
