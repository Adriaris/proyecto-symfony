<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CharacterRepository;
use App\Repository\RankRepository;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/characters", name="api_characters_list", methods={"GET"})
     */
    public function listCharacters(CharacterRepository $characterRepository): JsonResponse
    {
        $characters = $characterRepository->findAll();

        return $this->json($characters);
    }

    /**
     * @Route("/characters/{id}", name="api_character_detail", methods={"GET"})
     */
    public function detailCharacter(CharacterRepository $characterRepository, $id): JsonResponse
    {
        $character = $characterRepository->find($id);

        return $this->json($character);
    }

    /**
     * @Route("/ranks", name="api_ranks_list", methods={"GET"})
     */
    public function listRanks(RankRepository $rankRepository): JsonResponse
    {
        $ranks = $rankRepository->findAll();

        return $this->json($ranks);
    }

    /**
     * @Route("/ranks/{id}", name="api_rank_detail", methods={"GET"})
     */
    public function detailRank(RankRepository $rankRepository, $id): JsonResponse
    {
        $rank = $rankRepository->find($id);

        return $this->json($rank);
    }
}
