<?php

namespace App\Domains\Contract\Application;

use App\Domains\Contract\Infrastructure\ContractRespository;
use Illuminate\Support\Facades\File; 
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
        $name = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,20)."_".str_replace(' ', '', $contract->customername)."_".$contract->file->getClientOriginalName();
        $path = '/contractsfiles/'.$name;

        Storage::put('/public/'.$path,file_get_contents($contract->file));

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
        $contract = $this->getContract($id);

        if($contract){
            Storage::delete('/public/'.$contract->file);
            return $this->ContractRepository->deleteContract($id);
        }

    }
}
