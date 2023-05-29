<?php
// src/Controller/TicketController.php

namespace App\Controller;

use App\Entity\Ticket;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class TicketController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/api/tickets", name="create_ticket", methods={"POST"})
     */
    public function createTicket(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $entityManager = $this->entityManager;

        $ticket = new Ticket();
        $ticket->setReporterId($data['reporterId']);
        $ticket->setReportedId($data['reportedId']);
        $ticket->setTicketDescription($data['description']);
        $ticket->setCreatedAt(new \DateTime());
        $ticket->setUpdatedAt(new \DateTime());

        $entityManager->persist($ticket);
        $entityManager->flush();

        return $this->json([
            'message' => 'Ticket created successfully',
            'ticketId' => $ticket->getId(),
            'status' => 'success'
        ], 201);
    }

    /**
     * @Route("/api/reported-users/{status?}", name="reported_users", methods={"GET"})
     */
    public function getReportedUsers($status = null)
    {
        $entityManager = $this->entityManager;

        $queryBuilder = $entityManager->getRepository(Ticket::class)->createQueryBuilder('t')
            ->orderBy('t.reported_id', 'ASC');  // aquí es donde se hizo el cambio

        if ($status) {
            $queryBuilder->where('t.ticketStatus = :status')
                ->setParameter('status', $status);
        }

        $tickets = $queryBuilder
            ->getQuery()
            ->getResult();

        // Serializar y devolver la lista de usuarios reportados en formato JSON
        $response = [
            'status' => 'success',
            'code' => Response::HTTP_OK,
            'reportedUsers' => $tickets
        ];

        return $this->json($response);
    }

    /**
     * @Route("/api/tickets/{id}", name="update_ticket_status", methods={"PUT"})
     */
    public function updateTicketStatus(Request $request, Ticket $ticket): Response
    {
        $data = json_decode($request->getContent(), true);

        if ($data['status'] === 'solved') {
            $ticket->setTicketStatus('solved');
            $this->entityManager->flush();

            return new JsonResponse(['status' => 'success', 'message' => 'Ticket updated successfully'], Response::HTTP_OK);
        }

        return new JsonResponse(['status' => 'error', 'message' => 'Invalid status'], Response::HTTP_BAD_REQUEST);
    }
}
