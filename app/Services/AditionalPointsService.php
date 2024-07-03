<?php

namespace App\Domains\AditionalPoints\Application;

use App\Domains\AditionalPoints\Infrastructure\AditionalPointsRespository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AditionalPointsService
{
    private $AditionalPointsRepository;

    public function __construct(AditionalPointsRespository $AditionalPointsRepository)
    {
        $this->AditionalPointsRepository = $AditionalPointsRepository;
    }

    public function createAditionalPoints(Request $aditionalPoints)
    {
        return $this->AditionalPointsRepository->createAditionalPoints($aditionalPoints);
    }

    public function getAllAditionalPoints(int $userId)
    {
        return $this->AditionalPointsRepository->getAllAditionalPoints($userId);
    }

    public function getAditionalPoints(string $id)
    {
        return $this->AditionalPointsRepository->getAditionalPoints($id);
    }

    public function updateAditionalPoints(string $id, Request $aditionalPoints)
    {
        return $this->AditionalPointsRepository->updateAditionalPoints($id, $aditionalPoints);
    }

    public function deleteAditionalPoints(string $id)
    {
        return $this->AditionalPointsRepository->deleteAditionalPoints($id);
    }
}
