<?php
 
namespace App\Http\Controllers;

use App\Domains\Contract\Application\ContractService;
use Illuminate\Http\Request;
use ReflectionClass;

class ContractController extends Controller
{
    private $ContractService;

    public function __construct(ContractService $ContractService)
    {
        $this->ContractService = $ContractService;
    }

    public function createContract(Request $request){
        return $this->ContractService->createContract($request);
    }

    public function getAllContracts(int $userId){
        return $this->ContractService->getAllContracts($userId);
    }

    public function getContract(string $id){
        return $this->ContractService->getContract($id);  
    }

    public function updateContract(string $id, Request $request){
        return $this->ContractService->updateContract($id, $request);
    }

    public function deleteContract(string $id){
        return $this->ContractService->deleteContract($id);
    }

    public function getAllPoints(){
        return $this->ContractService->getAllPoints();
    }

    public function getAllPointsRegion(string $region){
        return $this->ContractService->getAllPointsRegion($region);
    }

    public function getPoints(int $userId){
        return $this->ContractService->getPoints($userId);
    }

}