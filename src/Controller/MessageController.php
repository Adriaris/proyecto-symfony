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
use App\Services\JwtAuth;

class MessageController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/message", methods={"POST"})
     */
    public function sendMessage(Request $request, EntityManagerInterface $em, JwtAuth $jwt_auth): Response
    {
        //RECOGER CABECERA AUTENTICACION 
        $token = $request->headers->get('Authorization');
        //CREAR METODO PARA COMPROBAR SI EL TOKEN ES CORRECTO 
        $authCheck = $jwt_auth->checkToken($token);

        //respuesta por defecto 
        $data = [
            'status' => 'error',
            'code' => 400,
            'message' => 'Metodo getMessages del controlador usuarios',
        ];

        //SI ES CORRECTO HACER LA ACTUALZIACION DEL USUARIO 
        if ($authCheck) {
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
        return new JsonResponse($data);
    }

    /**
     * @Route("/message/{senderId}/{receiverId}", methods={"GET"})
     */
    public function getMessages(int $senderId, int $receiverId, Request $request, JwtAuth $jwt_auth): Response
    {
        //RECOGER CABECERA AUTENTICACION 
        $token = $request->headers->get('Authorization');
        //CREAR METODO PARA COMPROBAR SI EL TOKEN ES CORRECTO 
        $authCheck = $jwt_auth->checkToken($token);

        //respuesta por defecto 
        $data = [
            'status' => 'error',
            'code' => 400,
            'message' => 'Metodo getMessages del controlador usuarios',
        ];

        //SI ES CORRECTO HACER LA ACTUALZIACION DEL USUARIO 
        if ($authCheck) {
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
        return new JsonResponse($data);
    }
}
