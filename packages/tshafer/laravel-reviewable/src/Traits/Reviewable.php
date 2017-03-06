<?php

    namespace Tshafer\Reviewable\Traits;

    use Illuminate\Database\Eloquent\Model;
    use Tshafer\Reviewable\Models\Review;


    /**
     * Class Reviewable
     *
     * @package Tshafer\Reviewable\Traits
     */
    trait Reviewable
    {

        /**
         * @return \Illuminate\Database\Eloquent\Relations\MorphMany
         */
        public function reviews()
        {
            return $this->morphMany( Review::class, 'reviewable' );
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\MorphMany
         */
        public function avragereviews()
        {
            $reviews= $this->morphMany( Review::class, 'reviewable' )->get();
            $rating=0;
            foreach($reviews as $review){
                $rating +=$review->rating;
            }
            if(count($reviews)==0){
                return 0;
            }
            return ceil($rating/count($reviews));
        }

        /**
         * @param            $data
         * @param Model      $author
         * @param Model|null $parent
         *
         * @return static
         */
        public function review( $data, Model $author, Model $parent = null )
        {
            return ( new Review() )->createReview( $this, $data, $author );
        }

        /**
         * @param            $id
         * @param            $data
         * @param Model|null $parent
         *
         * @return mixed
         */
        public function updateReview( $id, $data, Model $parent = null )
        {
            return ( new Review() )->updateReview( $id, $data );
        }

        /**
         * @param $id
         *
         * @return mixed
         */
        public function deleteReview( $id )
        {
            return ( new Review() )->deleteReview( $id );
        }
    }
