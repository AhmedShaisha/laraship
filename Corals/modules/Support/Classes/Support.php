<?php

namespace Corals\Modules\Support\Classes;
use Corals\User\Models\User;
use Corals\Modules\Support\Models\Response;
use Corals\Modules\Support\Models\CustomerSupport;
class Support
{
    /**
     * Foo constructor.
     */
    function __construct()
    {
    }

    public function getusersList()
    {
        $uesrs=User::whereHas('roles', function ( $query) {
            $query->where('name', '=', 'customerRelationshipManagement'); 
         })->get()->map->only('id','full_name');
        
        return $uesrs;
    }
    /**
     * @return string
     */
    public function createTicketNumber()
    {
        // Get the last created order
        $lastOrder = CustomerSupport::orderBy('id', 'desc')->first();
        $number = 0;
        // We get here if there is no order at all
        // If there is no number set it to 0, which will be 1 at the end.
        if ($lastOrder) {
            $number = substr($lastOrder->order_number, 4);
        }

        // If we have ORD-000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %05d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.

        return 'TIC-' . sprintf('%06d', intval($number) + 1);
    }
    public function showResponse(Response $response)
    {
        $response=Response::find($response->id);
        $responses=$customerSupport->responses;
        dd($responses);
        $responses= $responses->sortByDesc('created_at');
        return view('Support::customerSupports.showResponse')->with('responses',$responses);
    }
}