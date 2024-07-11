<?php

namespace App\Domains\Contract\Infrastructure;

use App\Models\AditionalPoints;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class ContractRespository
{

    public function createContract(Request $request){  
        return $this->getContract(Contract::create($request->all())->id);
    }

    public function getAllContracts(int $userId){
       return Contract::select('*')->where('user_id','=',$userId)->orderBy('contracts.id','desc')->paginate(10);    
    }

    public function getContract(string $id){
        return Contract::find($id);
    }

    public function getAllPoints(){

        $points = DB::select('SELECT users.id, users.companyname, users.country, users.region, ifnull(internal_promo,0) AS internal_promo, ifnull(net_new_sale,0) AS net_new_sale , ifnull(existing_customer_sale,0) AS existing_customer_sale, ifnull(aditional_points,0) AS aditional_points, SUM(ifnull(aditional_points,0) + ifnull(contracts_points,0)) AS total FROM users 

        LEFT JOIN (SELECT contracts.user_id, 
                   
        SUM(CASE WHEN contracts.saletype = "Internal promo" THEN contracts.points ELSE 0 END) AS internal_promo,
        SUM(CASE WHEN contracts.saletype = "Net New Sale" THEN contracts.points ELSE 0 END) AS net_new_sale, 
        SUM(CASE WHEN contracts.saletype = "Existing Customer Sale" THEN contracts.points ELSE 0 END) AS existing_customer_sale, 
        SUM(contracts.points) AS contracts_points 
        
        FROM contracts GROUP BY contracts.user_id) c ON c.user_id = users.id 
        
        LEFT JOIN (SELECT aditionalpoints.user_id, SUM(aditionalpoints.points) AS aditional_points FROM aditionalpoints GROUP BY aditionalpoints.user_id) a ON a.user_id = users.id

        WHERE `usertype` LIKE "USER" GROUP BY users.id ORDER BY total DESC LIMIT 10');

        return $points;
    }

    public function getAllPointsRegion(string $region){

        $points = DB::select('SELECT users.id, users.companyname, users.country, users.region, ifnull(internal_promo,0) AS internal_promo, ifnull(net_new_sale,0) AS net_new_sale , ifnull(existing_customer_sale,0) AS existing_customer_sale, ifnull(aditional_points,0) AS aditional_points, SUM(ifnull(aditional_points,0) + ifnull(contracts_points,0)) AS total FROM users

        LEFT JOIN (SELECT contracts.user_id, 
                   
        SUM(CASE WHEN contracts.saletype = "Internal promo" THEN contracts.points ELSE 0 END) AS internal_promo,
        SUM(CASE WHEN contracts.saletype = "Net New Sale" THEN contracts.points ELSE 0 END) AS net_new_sale, 
        SUM(CASE WHEN contracts.saletype = "Existing Customer Sale" THEN contracts.points ELSE 0 END) AS existing_customer_sale, 
        SUM(contracts.points) AS contracts_points 
        
        FROM contracts GROUP BY contracts.user_id) c ON c.user_id = users.id 
        
        LEFT JOIN (SELECT aditionalpoints.user_id, SUM(aditionalpoints.points) AS aditional_points FROM aditionalpoints GROUP BY aditionalpoints.user_id) a ON a.user_id = users.id

        WHERE `region` LIKE "'.$region.'" AND `usertype` LIKE "USER" GROUP BY users.id ORDER BY total DESC LIMIT 10');

        return $points;        
    }
    
    public function getPoints(int $userId){
        $points = DB::select('SELECT users.id, users.companyname, users.country, users.region, ifnull(internal_promo,0) AS internal_promo, ifnull(net_new_sale,0) AS net_new_sale , ifnull(existing_customer_sale,0) AS existing_customer_sale, ifnull(aditional_points,0) AS aditional_points, SUM(ifnull(aditional_points,0) + ifnull(contracts_points,0)) AS total FROM users 

        LEFT JOIN (SELECT contracts.user_id, 
                   
        SUM(CASE WHEN contracts.saletype = "Internal promo" THEN contracts.points ELSE 0 END) AS internal_promo,
        SUM(CASE WHEN contracts.saletype = "Net New Sale" THEN contracts.points ELSE 0 END) AS net_new_sale, 
        SUM(CASE WHEN contracts.saletype = "Existing Customer Sale" THEN contracts.points ELSE 0 END) AS existing_customer_sale, 
        SUM(contracts.points) AS contracts_points 
        
        FROM contracts GROUP BY contracts.user_id) c ON c.user_id = users.id 
        
        LEFT JOIN (SELECT aditionalpoints.user_id, SUM(aditionalpoints.points) AS aditional_points FROM aditionalpoints GROUP BY aditionalpoints.user_id) a ON a.user_id = users.id AND usertype = "USER"
        WHERE `id` LIKE "'.$userId.'" AND `usertype` LIKE "USER" GROUP BY users.id ORDER BY total DESC');

        return $points;  
    }

    public function deleteContract(string $id){
        return Contract::find($id)->delete();
    }
}
