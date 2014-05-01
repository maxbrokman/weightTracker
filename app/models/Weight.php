<?php
/**
 * Created by PhpStorm.
 * User: maxbrokman
 * Date: 01/05/2014
 * Time: 02:49
 */

class Weight extends Eloquent {

    /**
     * User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }
} 