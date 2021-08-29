<?php

namespace App\Traits;

use App\Models\Setting;

trait helperTrait
{

    /**
     * @imageRequest the image which come from the fill form
     * @placeMove the place will this method move the image to it .
     */
    public function uploadImages($imageRequest, $placeMove)
    {
        $img = time() . md5(uniqid()) . "." . $imageRequest->guessExtension();
        $imageRequest->move(public_path("$placeMove"), $img);
        return  $img;
    }

    //  To get Pagination for resource
    public function getPaginates($collection)
    {
        return [
            "per_page" => $collection->perPage(),
            "path" => $collection->path(),
            "total" => $collection->total(),
            "current_page" => $collection->currentPage(),
            "last_page" => $collection->lastPage(),
            "has_more_pages" => $collection->hasMorePages()

        ];
    }


    // To Get Settings


    public function settings()
    {
        return Setting::find(1);
    }
}
