<?php

namespace Divide\CMS;

class Picture extends \Eloquent {

    //protected $fillable = [];
    protected $table = 'pictures';
    
    public function gallery() {
        return $this->belongsTo('Divide\CMS\Gallery');
    }

}
