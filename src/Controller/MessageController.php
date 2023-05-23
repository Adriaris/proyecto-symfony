<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Message;
use App\Entity\User;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class MessageController extends AbstractController
{

    private $entityManager;
    private $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }
    /**
     * @Route("/message", methods={"POST"})
     */
    public function sendMessage(Request $request, EntityManagerInterface $em): Response
    {
        $data = json_decode($request->getContent(), true);

        // Busca las entidades de Usuario para el emisor y el receptor
        $userRepository = $this->entityManager->getRepository(User::class);
        $sender = $userRepository->find($data['sender_id']);
        $receiver = $userRepository->find($data['receiver_id']);

        $message = new Message();
        $message->setSender($sender);
        $message->setReceiver($receiver);
        $message->setMessage($data['message']);
        $message->setSentAt(new \DateTime());

        $em->persist($message);
        $em->flush();

        return new JsonResponse(['message' => 'Message sent successfully'], Response::HTTP_OK);

    }

/**
 * @Route("/message/{senderId}/{receiverId}", methods={"GET"})
 */
public function getMessages(int $senderId, int $receiverId): Response
{
    $repository = $this->entityManager->getRepository(Message::class);
    
    // Obtenemos los mensajes enviados y recibidos entre los dos usuarios
    $messages = $repository->createQueryBuilder('m')
        ->where('(m.sender = :senderId AND m.receiver = :receiverId) OR (m.sender = :receiverId AND m.receiver = :senderId)')
        ->setParameter('senderId', $senderId)
        ->setParameter('receiverId', $receiverId)
        ->orderBy('m.sentAt', 'ASC')
        ->getQuery()
        ->getResult();

    // Convierte los mensajes a un formato apto para JSON
    $messageData = array_map(function (Message $message) {
        return [
            'id' => $message->getId(),
            'sender_id' => $message->getSender()->getId(),
            'receiver_id' => $message->getReceiver()->getId(),
            'message' => $message->getMessage(),
            'sent_at' => $message->getSentAt()->format(\DateTime::ISO8601),
        ];
    }, $messages);

    // Devuelve los mensajes como JSON
    return new JsonResponse($messageData);
}




    /**
     * @Route("/message/{messageId}", methods={"DELETE"})
     */
    public function deleteMessage(int $messageId, EntityManagerInterface $em): Response
    {
        $repository = $this->entityManager->getRepository(Message::class);
        $message = $repository->find($messageId);

        if ($message) {
            $em->remove($message);
            $em->flush();

            return new Response('Message deleted successfully', Response::HTTP_OK);
        } else {
            return new Response('Message not found', Response::HTTP_NOT_FOUND);
        }
    }
}
