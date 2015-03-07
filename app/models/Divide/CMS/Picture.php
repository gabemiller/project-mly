<?php

namespace Divide\CMS;

/**
 * Divide\CMS\Picture
 *
 * @property-read \Divide\CMS\Gallery $gallery 
 */
class Picture extends \Eloquent {

    //protected $fillable = [];
    protected $table = 'pictures';
    
    public function gallery() {
        return $this->belongsTo('Divide\CMS\Gallery');
    }

}
