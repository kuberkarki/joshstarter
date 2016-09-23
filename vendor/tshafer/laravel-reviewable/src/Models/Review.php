<?php

    namespace Tshafer\Reviewable\Models;

    use Illuminate\Database\Eloquent\Model;


    /**
     * Class Review
     *
     * @package Tshafer\Reviewable\Models
     */
    class Review extends Model
    {

        /**
         * @var array
         */
        protected $guarded = [ 'id', 'created_at', 'updated_at' ];

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
            return $this->morphTo( 'author' );
        }

        /**
         * @param Model $reviewable
         * @param       $data
         * @param Model $author
         *
         * @return static
         */
        public function createReview( Model $reviewable, $data, Model $author )
        {
            $review = new static();
            $review->fill( array_merge( $data, [
                'author_id'   => $author->id,
                'author_type' => get_class( $author ),
            ] ) );

            $reviewable->reviews()->save( $review );

            return $review;
        }

        /**
         * @param $id
         * @param $data
         *
         * @return mixed
         */
        public function updateReview( $id, $data )
        {
            $review = static::find( $id );
            $review->update( $data );

            return $review;
        }

        /**
         * @param $id
         *
         * @return mixed
         */
        public function deleteReview( $id )
        {
            return static::find( $id )->delete();
        }
    }
