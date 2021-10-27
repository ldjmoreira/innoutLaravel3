<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MonthlyReportCollection extends ResourceCollection
{
 /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
	    return [
			'data' => $this->balanceSign
            
        ];
    }

    public function with($request)
    {
    	return [
    		'balanceSig' => 'Dado adicional',
		    'extra'             => 'Dado adicional'
	    ];
    }
}
