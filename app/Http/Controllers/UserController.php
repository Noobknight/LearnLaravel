<?php

namespace App\Http\Controllers;

use App\Model\Property;
use App\Utils\CommonUtils;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;

class UserController extends ApiController
{

    /**
     * UserController constructor.
     * @param ResponseFactory $response
     * @param Request $request
     */
    public function __construct(ResponseFactory $response, Request $request)
    {
        parent::__construct($response, $request);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getListUsers(Request $request)
    {
        $limit = $request->input('limit');
        $offset = $request->input('offset');
        $result = DB::table('users as U')->select('U.id', 'P.first_name', 'P.last_name', 'P.avatar', 'P.age', 'P.avatar', 'P.birthday', 'P.country',
            'P.city', 'P.phone_number', 'U.email', 'U.created_at', 'U.last_sign_in_at', 'U.last_sign_in_ip')
            ->leftJoin('user_profiles as P', 'P.user_id', '=', 'U.id')
            ->limit($limit)
            ->offset($offset)
            ->get();
        return $this->responseEntity($result, true);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getProperties(Request $request)
    {
        $limit = $request->input('limit');
        $offset = $request->input('offset');
        $pageLimit = CommonUtils::getResultLimitOffset($limit, $offset);
        $data = DB::table('properties as P')
            ->join('property_ownerships as PO', 'P.id', '=', 'PO.property_id')
            ->join('user_profiles as UP', 'UP.user_id', '=', 'PO.user_id')
            ->select('PO.user_id', 'UP.first_name', 'UP.last_name', 'P.name', 'UP.email',
                'UP.phone_number', 'P.weekly_price', 'P.deposit', 'P.area', 'P.description', 'P.cover', 'UP.about_me')
            ->limit($pageLimit['limit'])
            ->offset($pageLimit['offset'])
            ->get();
        return $this->responseEntity($data, true);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetailProperty(Request $request)
    {
        $pId = $request->input('pId');
        if ($pId != null && $pId > -1) {
            $data = Property::findOrFail($pId)->toArray();
            return $this->responseEntity($data, false);
        }
        return $this->responseNotFound(204, "Property not found");
    }


    public function getUserById(Request $request)
    {
        $id = $request->input('uid');
        if ($id != null && $id > -1) {
            $user = DB::table('users as U')->select('U.id', 'P.first_name', 'P.last_name', 'P.avatar', 'P.age', 'P.avatar', 'P.birthday', 'P.country',
                'P.city', 'P.phone_number', 'U.email', 'U.created_at', 'U.last_sign_in_at', 'U.last_sign_in_ip')
                ->leftJoin('user_profiles as P', 'P.user_id', '=', 'U.id')
                ->where('U.id', '=', $id)
                ->get();
            return $this->responseEntity($user, false);
        }
        return $this->responseNotFound(204, "User not found");
    }

}
