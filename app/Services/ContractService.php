<?php

namespace App\Domains\Contract\Application;

use App\Domains\Contract\Infrastructure\ContractRespository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractService
{
    private $ContractRepository;

    public function __construct(ContractRespository $ContractRepository)
    {
        $this->ContractRepository = $ContractRepository;
    }

    public function createContract(Request $contract)
    {
        $name = $contract->customername ."_".$contract->file->getClientOriginalName();
        $path = '/contractsfiles/'.$name;
        Storage::disk('local')->put('.'. $path, file_get_contents($contract->file));

        $newContract = new Request($contract->all());
        $newContract->merge(['file' => $path]);

        if($contract->saletype == "Internal promo"){
            $newContract['points'] = 5;
        }

        if($contract->saletype == "Net New Sale"){
            $newContract['points'] = 10;
        }

        if($contract->saletype == "Existing Customer Sale"){
            $newContract['points'] = 15;
        }
        
        return $this->ContractRepository->createContract($newContract);
    }

    public function getAllContracts(int $userId)
    {
        return $this->ContractRepository->getAllContracts($userId);
    }

    public function getContract(string $id)
    {
        return $this->ContractRepository->getContract($id);
    }

    public function updateContract(string $id, Request $contract)
    {

        $name = $contract->customername ."_".$contract->file->getClientOriginalName();
        $path = './contracts/'.$name;
        Storage::disk('local')->put($path, file_get_contents($contract->file));

        $newContract = new Request($contract->all());
        $newContract->merge(['file' => $path]);

        if($newContract->customertype == "Internal promo"){
            $newContract->merge(['points' => 5]);
        }

        if($newContract->customertype == "Net New Sale"){
            $newContract->merge(['points' => 10]);
        }

        if($newContract->customertype == "Existing Customer Sale"){
            $newContract->merge(['points' => 15]);
        }
        
        return $this->ContractRepository->updateContract($id, $newContract);
    }

    public function getAllPoints(){
        return $this->ContractRepository->getAllPoints();
    }

    public function getAllPointsRegion(string $region){
        return $this->ContractRepository->getAllPointsRegion($region);
    }

    public function getPoints(int $userId){
        return $this->ContractRepository->getPoints($userId);
    }

    public function deleteContract(string $id)
    {
        return $this->ContractRepository->deleteContract($id);
    }
}
