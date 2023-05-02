<?php

namespace App\Command;

use App\Services\ValorantApiService;
use App\Services\RanksApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateAgentsCommand extends Command
{
    private $entityManager;
    private $valorantApiService;
    private $ranksApiService;

    public function __construct(EntityManagerInterface $entityManager, ValorantApiService $valorantApiService, RanksApiService $ranksApiService)
    {
        $this->entityManager = $entityManager;
        $this->valorantApiService = $valorantApiService;
        $this->ranksApiService = $ranksApiService;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:update-agents')
            ->setDescription('Updates agent data from the Valorant API');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $agentsData = $this->valorantApiService->getAgents();

        if ($agentsData !== null) {
            $agents = $agentsData['data'];

            foreach ($agents as $agent) {
                $character = $this->entityManager->getRepository(\App\Entity\Character::class)->findOneBy(['displayName' => $agent['displayName']]);

                if (!$character) {
                    $character = new \App\Entity\Character();
                }

                // Utilizamos un ID manual generado a partir del DisplayName del agente
                $id = strtolower(str_replace(' ', '_', $agent['displayName']));
                $character->setIdCharacter($id);

                $character->setDisplayName($agent['displayName']);
                $character->setImgCharacter($agent['displayIcon']);

                $this->entityManager->persist($character);
            }

            $this->entityManager->flush();
            $output->writeln('Agents data updated successfully.');
        } else {
            $output->writeln('Error: Failed to update agents data.');
        }

        // Actualizamos los rangos competitivos
        $ranks = $this->ranksApiService->getCompetitiveTiers();

        if ($ranks !== null) {

            foreach ($ranks as $rank) {
                $rankRepository = $this->entityManager->getRepository(\App\Entity\Rank::class);
                $rankEntity = $rankRepository->findOneBy(['gameRank' => $rank['tierName']]);

                if (strpos($rank['tierName'], 'Unused') === false) {
                    // El string no contiene la palabra "Unused"
                    if (!$rankEntity) {
                        $rankEntity = new \App\Entity\Rank();
                    }
                
                    $rankEntity->setGameRank($rank['tierName']);
                    $rankEntity->setImgRank($rank['smallIcon']);
                
                    $this->entityManager->persist($rankEntity);
                }
                
            }

            $this->entityManager->flush();
            $output->writeln('Competitive tiers data updated successfully.');
        } else {
            $output->writeln('Error: Failed to update competitive tiers data.');
        }

        return Command::SUCCESS;
    }
}
