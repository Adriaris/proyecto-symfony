<?php

namespace App\Controller;

use App\Entity\Friend;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\JwtAuth;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use App\Entity\Character;

class FriendController extends AbstractController
{
    private $entityManager;
    private $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    private function resjson($data)
    {
        // Serializar datos con servicio serializer
        //$json = $this->serializer->serialize($data, 'json'); 
        $json = $this->serializer->serialize($data, 'json', [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object) {
                if ($object instanceof Character) {
                    return $object->getIdCharacter();
                }
                return $object->getId();
            },
            AbstractNormalizer::CIRCULAR_REFERENCE_LIMIT => 1
        ]);

        // Response con httpfundation
        $response = new Response();

        // Asignar contenido a la respuesta 
        $response->setContent($json);

        // Indicar formato de respuesta
        $response->headers->set('Content-Type', 'application/json');

        // Devolver la respuesta 
        return $response;
    }


    public function addFriend(Request $request): JsonResponse
    {
        // Recoger datos por post
        $json = $request->get('json', null);

        // Decodificar json
        $params = json_decode($json, true);

        // Verificar si se han enviado los datos necesarios
        if (!$params || !isset($params['userId1']) || !isset($params['userId2'])) {
            return new JsonResponse(['error' => 'Missing required parameters.'], Response::HTTP_BAD_REQUEST);
        }

        // Obtener los datos necesarios de los parámetros
        $idUser1 = $params['userId1'];
        $idUser2 = $params['userId2'];
        $user1Locked = $params['user1Locked'] ?? false;
        $user2Locked = $params['user2Locked'] ?? false;

        // Verificar si los usuarios ya son amigos
        $friendRepository = $this->entityManager->getRepository(Friend::class);
        $friend1 = $friendRepository->findOneBy([
            'userId1' => $idUser1,
            'userId2' => $idUser2,
        ]);
        $friend2 = $friendRepository->findOneBy([
            'userId1' => $idUser2,
            'userId2' => $idUser1,
        ]);
        if ($friend1 || $friend2) {
            return new JsonResponse(['status' => 'repeated', 'message' => 'Users are already friends.']);
        } else if ($idUser1 == $idUser2) {
            return new JsonResponse(['status' => 'same-user', 'message' => 'You can not invite yourself']);
        }

        // Crear una nueva instancia de la entidad Friend
        $friend = new Friend();
        $friend->setUserId1($idUser1);
        $friend->setUserId2($idUser2);
        $friend->setFriendshipStatus(Friend::STATUS_PENDING);
        $friend->setUser1Locked($user1Locked);
        $friend->setUser2Locked($user2Locked);

        // Guardar la entidad Friend en la base de datos
        $entityManager = $this->entityManager;
        $entityManager->persist($friend);
        $entityManager->flush();

        // Devolver una respuesta JSON con los datos de la nueva solicitud de amistad
        $response = [
            'id' => $friend->getId(),
            'userId1' => $friend->getUserId1(),
            'userId2' => $friend->getUserId2(),
            'friendshipStatus' => $friend->getFriendshipStatus(),
            'user1Locked' => $friend->isUser1Locked(),
            'user2Locked' => $friend->isUser2Locked(),
        ];

        return new JsonResponse($response, Response::HTTP_CREATED);
    }

    public function checkFriendship(Request $request, JwtAuth $jwtAuth): JsonResponse
    {
        // Recoger token y comprobar si es válido
        $token = $request->headers->get('Authorization');
        $authCheck = $jwtAuth->checkToken($token);

        if ($authCheck) {
            // Conseguir datos del usuario identificado
            $identity = $jwtAuth->checkToken($token, true);

            // Verificar si se han enviado los datos necesarios
            $idUser2 = $request->get('idUser2');
            if (!$idUser2) {
                return new JsonResponse(['error' => 'Missing required parameters.'], Response::HTTP_BAD_REQUEST);
            }

            // Obtener el id del usuario que realiza la petición
            $idUser1 = $identity->sub;

            // Verificar si los usuarios ya son amigos
            $friendRepository = $this->entityManager->getRepository(Friend::class);
            $friend1 = $friendRepository->findOneBy([
                'userId1' => $idUser1,
                'userId2' => $idUser2,
                'friendshipStatus' => Friend::STATUS_ACCEPTED
            ]);
            $friend2 = $friendRepository->findOneBy([
                'userId1' => $idUser2,
                'userId2' => $idUser1,
                'friendshipStatus' => Friend::STATUS_ACCEPTED
            ]);
            $friendRequest1 = $friendRepository->findOneBy([
                'userId1' => $idUser1,
                'userId2' => $idUser2,
                'friendshipStatus' => Friend::STATUS_PENDING
            ]);
            $friendRequest2 = $friendRepository->findOneBy([
                'userId1' => $idUser2,
                'userId2' => $idUser1,
                'friendshipStatus' => Friend::STATUS_PENDING
            ]);

            if ($friend1 || $friend2) {
                return new JsonResponse(['status' => 'friends', 'message' => 'Users are already friends.']);
            } else if ($friendRequest1 || $friendRequest2) {
                return new JsonResponse(['status' => 'pending', 'message' => 'There is a pending friend request between these users.']);
            } else if ($idUser1 == $idUser2) {
                return new JsonResponse(['status' => 'same-user', 'message' => 'You cannot invite yourself.']);
            } else {
                return new JsonResponse(['status' => 'ok', 'message' => 'Users are not already friends.']);
            }
        } else {
            return new JsonResponse(['error' => 'Unauthorized.'], Response::HTTP_UNAUTHORIZED);
        }
    }




    public function getPendingFriendRequests(Request $request, JwtAuth $jwt_auth)
    {
        // Recoger token y comprobar si es válido
        $token = $request->headers->get('Authorization');
        $authCheck = $jwt_auth->checkToken($token);

        if ($authCheck) {
            // Conseguir datos del usuario identificado
            $identity = $jwt_auth->checkToken($token, true);

            // Buscar solicitudes pendientes del usuario identificado
            $friendRepository = $this->entityManager->getRepository(Friend::class);
            $friendRequests = $friendRepository->findBy([
                'userId2' => $identity->sub,
                'friendshipStatus' => Friend::STATUS_PENDING
            ]);

            // Crear array con datos de cada solicitud
            $friendRequestsArray = [];
            foreach ($friendRequests as $request) {
                $user1Repository = $this->entityManager->getRepository(User::class);
                $user1 = $user1Repository->find($request->getUserId1());

                $friendRequestsArray[] = [
                    'id' => $request->getId(),
                    'nickname' => $user1->getNickname(),
                    //'email' => $user1->getEmail(),
                    //'createdAt' => $request->getCreatedAt()
                ];
            }

            // Devolver respuesta con solicitudes pendientes
            //return new JsonResponse($friendRequestsArray);
            return $this->resjson($friendRequestsArray);
        } else {
            // Token no válido
            //return new JsonResponse(['error' => 'Invalid token.'], Response::HTTP_UNAUTHORIZED);
            return $this->resjson(['error' => 'Invalid token.']);
        }
    }

    public function updateFriendshipStatus(Request $request, JwtAuth $jwt_auth): JsonResponse
    {
        // Recoger token y comprobar si es válido
        $token = $request->headers->get('Authorization');
        $authCheck = $jwt_auth->checkToken($token);

        if ($authCheck) {
            // Conseguir datos del usuario identificado
            $identity = $jwt_auth->checkToken($token, true);

            // Recoger datos de la petición
            $friendRequestId = $request->attributes->get('id');
            $newStatus = $request->attributes->get('status');

            // Buscar solicitud de amistad por ID
            $friendRepository = $this->entityManager->getRepository(Friend::class);
            $friendRequest = $friendRepository->findOneBy([
                'id' => $friendRequestId,
                'userId2' => $identity->sub,
                'friendshipStatus' => Friend::STATUS_PENDING
            ]);

            if ($friendRequest) {
                // Actualizar estado de la solicitud de amistad
                $friendRequest->setFriendshipStatus($newStatus);
                $this->entityManager->persist($friendRequest);
                $this->entityManager->flush();

                // Devolver respuesta con solicitud actualizada
                return new JsonResponse([
                    'status' => 'success',
                    'message' => 'Friendship status updated.'
                ]);
            } else {
                // No se encuentra la solicitud de amistad o no pertenece al usuario identificado
                return new JsonResponse(['error' => 'Friend request not found.'], Response::HTTP_NOT_FOUND);
            }
        } else {
            // Token no válido
            return new JsonResponse(['error' => 'Invalid token.'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function listFriends(Request $request, JwtAuth $jwt_auth): JsonResponse
    {
        // Recoger token y comprobar si es válido
        $token = $request->headers->get('Authorization');
        $authCheck = $jwt_auth->checkToken($token);

        if ($authCheck) {
            // Conseguir datos del usuario identificado
            $identity = $jwt_auth->checkToken($token, true);

            // Obtener el id del usuario a través del token
            $userId = $identity->sub;

            // Buscar amigos del usuario
            $friendRepository = $this->entityManager->getRepository(Friend::class);
            $friends = $friendRepository->createQueryBuilder('f')
                ->where('f.userId1 = :userId OR f.userId2 = :userId')
                ->setParameter('userId', $userId)
                ->getQuery()
                ->getResult();


            // Devolver la lista de amigos
            $friendsList = [];
            foreach ($friends as $friend) {
                if ($friend->getFriendshipStatus() == Friend::STATUS_ACCEPTED) {
                    $friendId = $friend->getUserId1() == $userId ? $friend->getUserId2() : $friend->getUserId1();
                    $friendRepository = $this->entityManager->getRepository(User::class);
                    $friendUser = $friendRepository->find($friendId);
                    $friendsList[] = [
                        'id' => $friendUser->getId(),
                        'name' => $friendUser->getNickname(),
                        //'email' => $friendUser->getEmail(),
                        //'avatar' => $friendUser->getAvatar(),
                    ];
                }
            }

            return new JsonResponse($friendsList);
        } else {
            return new JsonResponse(['error' => 'Invalid token.'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
