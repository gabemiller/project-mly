<?php

namespace Divide\CMS;

use Str;

class Article extends \Eloquent {

    use \Conner\Tagging\TaggableTrait;
    //protected $fillable = [];
    protected $table = 'articles';

    /**
     * 
     * @return type
     */
    public function gallery() {
        return $this->belongsTo('Divide\CMS\Gallery');
    }

    /**
     * 
     * @return type
     */
    public function getGalleryId() {
        return $this->gallery_id == 0 ? 0 : $this->gallery->id;
    }

    /**
     * 
     * @return type
     */
    public function author() {
        return $this->belongsTo('Divide\CMS\User');
    }

    /**
     * 
     * @return type
     */
    public function getAuthorName() {
        return $this->author->last_name . ' ' . $this->author->first_name;
    }

    /**
     * 
     * @return type
     */
    public function getCreateDate() {
        return substr(str_replace('-', '.', $this->created_at), 0, 16);
    }

    /**
     * 
     * @param type $characters
     * @param type $end
     * @return type
     */
    public function getParragraph($characters = 500, $end = '...') {
        return Str::limit(strip_tags($this->content), $characters, $end);
    }

    /**
     * 
     * @return type
     */
    public function getLink() {
        return 'hirek/' . $this->id . '/' . Str::slug($this->title);
    }

}
