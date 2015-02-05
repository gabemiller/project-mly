<?php

namespace Divide\Helper;

class Tag extends \Eloquent {

    /**
     *
     * @var type 
     */
    protected $table = 'tagging_tags';

    /**
     * 
     * @param type $name
     * @return type
     */
    public static function getTagByName(array $names) {
        return Tag::whereIn('name', $names)->get(['id','name','slug']);
    }

}
