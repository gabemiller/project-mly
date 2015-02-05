<?php

namespace Divide\CMS;

use Str;

class Gallery extends \Eloquent {

    protected $fillable = ['name'];
    protected $table = 'gallery';

    /**
     * 
     * @return type
     */
    public static function getGalleries() {
        $array = array('0' => 'Válassz galériát!');

        foreach (Gallery::all(['id','name']) as $gallery) {
            $array[$gallery->id] = $gallery->name;
        }

        return $array;
    }

    /**
     * 
     * @return type
     */
    public function pictures() {
        return $this->hasMany('Divide\CMS\Picture');
    }

    /**
     * 
     * @return type
     */
    public function getSlugName() {
        return Str::slug($this->name);
    }

    /**
     * 
     * @param type $characters
     * @param type $end
     * @return type
     */
    public function getDescription($characters = 100, $end = '...') {
        return Str::limit(strip_tags($this->description), $characters, $end);
    }

    /**
     * 
     * @return type
     */
    public function getUpdateDate() {
        return substr(str_replace('-', '.', $this->updated_at), 0, 16);
    }

    /**
     * 
     */
    public function hasPicture() {
        if (count($this->pictures) > 0) {
            return true;
        } else {
            return false;
        }
    }

}
