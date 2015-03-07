<?php

namespace Divide\CMS;

/**
 * Divide\CMS\Document
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Divide\CMS\DocumentCategory[] $categories 
 */
class Document extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'path'];

    /**
     * @var string
     */
    protected $table = 'document';

    /**
     * @return mixed
     */
    public function categories()
    {
        return $this->belongsToMany('Divide\CMS\DocumentCategory', 'document_documentcategory', 'document_id', 'documentcategory_id');
    }


    /**
     * @return array
     */
    public function getCategoryIds()
    {
        $ids = array();

        foreach ($this->categories as $cat) {
            $ids[] = $cat->id;
        }

        return $ids;

    }

}
