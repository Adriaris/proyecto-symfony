<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Availability;
use App\Entity\Character;
use App\Entity\Ambition;
use App\Entity\Rank;
use App\Entity\SoloRole;
use App\Entity\TeamRole;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validation;
use App\Services\JwtAuth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Exception;




class UserController extends AbstractController
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



    public function index(): Response
    {
        $user_Repo = $this->entityManager->getRepository(User::class);

        $users = $user_Repo->findAll();
        $user = $user_Repo->find(1);

        return $this->resjson($user);
    }

    public function register(Request $request)
    {
        // Recoger datos por post
        $json = $request->get('json', null);

        // Decodificar json
        $params = json_decode($json, true);

        // Hacer respuesta por defecto 
        $data = [
            'status' => 'error',
            'code' => '200',
            'message' => 'El usuario no ha sido creado',
            //'pruebas' => $params
        ];
        try {
            // Comprobar y validar datos 
            if (!empty($json)) {
                // Validar campos requeridos
                $required_fields = ['nickname', 'nationality', 'email', 'passwd', 'id_availability', 'id_rank', 'id_ambition', 'id_srole', 'id_trole', 'id_first_character', 'id_second_character', 'id_third_character'];
                foreach ($required_fields as $field) {
                    if (empty($params[$field])) {
                        $data['message'] = "The field '$field' is required";
                        //$data['pruebas'] = $params;
                        return $this->resjson($data);
                    }
                }

                // Validar email
                if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['message'] = "The email is not valid";
                    return $this->resjson($data);
                }

                // Comprobar si ya existe un usuario con ese email
                $userRepository = $this->entityManager->getRepository(User::class);
                $existingUser = $userRepository->findOneBy(['email' => $params['email']]);
                if ($existingUser) {
                    $data['message'] = "There is already a user with that email";
                    return $this->resjson($data);
                }

                // Comprobar si ya existe un usuario con ese nickname
                $existingNickname = $userRepository->findOneBy(['nickname' => $params['nickname']]);
                if ($existingNickname) {
                    $data['message'] = "There is already a user with that nickname";
                    return $this->resjson($data);
                }

                // Validar fecha de nacimiento
                /*if (!empty($params['age']) && !\DateTime::createFromFormat('Y-m-d', $params['age'])) {
                $data['message'] = "The date of birth is invalid";
                return $this->resjson($data);
            }*/

                // Crear objeto User
                $user = new User();
                $user->setNickname($params['nickname']);
                if (!empty($params['age'])) {
                    $user->setAge(new \DateTime($params['age']));
                }
                $user->setNationality($params['nationality']);
                if (!empty($params['short_description'])) {
                    $user->setShortDescription($params['short_description']);
                }
                $user->setEmail($params['email']);
                $user->setPasswd(password_hash($params['passwd'], PASSWORD_DEFAULT));


                // Asociar objetos (fk bbdd)
                $availabilityRepository = $this->entityManager->getRepository(Availability::class);
                $user->setIdAvailability($availabilityRepository->find($params['id_availability']));

                $rankRepository = $this->entityManager->getRepository(Rank::class);
                $rank = $rankRepository->find($params['id_rank']);
                $user->setIdRank($rank);

                $ambitionRepository = $this->entityManager->getRepository(Ambition::class);
                $user->setIdAmbition($ambitionRepository->find($params['id_ambition']));

                $sroleRepository = $this->entityManager->getRepository(SoloRole::class);
                $user->setIdSrole($sroleRepository->find($params['id_srole']));

                $troleRepository = $this->entityManager->getRepository(TeamRole::class);
                $user->setIdTrole($troleRepository->find($params['id_trole']));

                $characterRepository = $this->entityManager->getRepository(Character::class);
                $user->setIdFirstCharacter($characterRepository->find($params['id_first_character']));
                $user->setIdSecondCharacter($characterRepository->find($params['id_second_character']));
                $user->setIdThirdCharacter($characterRepository->find($params['id_third_character']));
                $user->setRole('user');


                // Guardar usuario en la base de datos
                $entityManager = $this->entityManager;

                $entityManager->persist($user);
                $entityManager->flush();

                // Cambiar respuesta por defecto
                $data['status'] = 'success';
                $data['code'] = '201';
                $data['message'] = 'El usuario ha sido creado correctamente';
            }
        } catch (Exception $e) {
            $data['status'] = 'error';
            $data['code'] = '400';
            $data['message'] = $e->getMessage();
        }

        return $this->resjson($data);
    }

    public function login(Request $request, JwtAuth $jwt_auth)
    {
        // Recibir los datos por post 
        $json = $request->get('json', null);

        // Array por defecto para devolver 
        $data = [
            'status' => 'error',
            'code' => 400,
            'message' => 'Datos incorrectos'
        ];

        //comprobar y validar datos 
        if ($json != null) {
            $params = json_decode($json, true);

            $email = !empty($params['email']) ? $params['email'] : null;
            $password = !empty($params['passwd']) ? $params['passwd'] : null;
            $gettoken = !empty($params['gettoken']) ? $params['gettoken'] : null;


            if (!empty($email) && !empty($password)) {
                // Cifrar la contraseña 
                //$passwd = hash('sha256', $password);
                //$passwd = (password_hash($password, PASSWORD_DEFAULT));
                $passwd = $password;


                //validar email
                if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['message'] = "El email no es válido";
                    return $this->resjson($data);
                }

                // Si todo es válido 
                // Si las credenciales son correctas, generar token JWT y devolver respuesta
                if ($gettoken) {
                    $signup = $jwt_auth->signup($email, $passwd, $gettoken);
                } else {
                    $signup = $jwt_auth->signup($email, $passwd);
                }

                return new JsonResponse($signup);
            }
        }

        return $this->resjson($data);
    }

    public function updateProfileImg(Request $request, JwtAuth $jwt_auth)
    {
        // Recoger cabecera de autenticación
        $token = $request->headers->get('Authorization');
        // Crear método para comprobar si el token es correcto
        $authCheck = $jwt_auth->checkToken($token);

        // Respuesta por defecto
        $data = [
            'status' => 'error',
            'code' => Response::HTTP_BAD_REQUEST,
            'message' => 'Invalid request.',
        ];

        // Si el token es correcto, realizar la actualización del usuario
        if ($authCheck) {
            // Conseguir el entity manager
            $em = $this->entityManager;

            // Conseguir los datos del usuario autenticado
            $identity = $jwt_auth->checkToken($token, true);

            // Conseguir el usuario a actualizar
            $userRepository = $em->getRepository(User::class);
            $user = $userRepository->findOneBy([
                'id' => $identity->sub
            ]);

            // Comprobar si se proporcionó la imagen en la solicitud
            if ($request->files->has('image')) {
                // Obtener el archivo de imagen
                $file = $request->files->get('image');

                // Generar un nombre único para el archivo
                $fileName = md5(uniqid()) . '.' . $file->getClientOriginalExtension();

                // Mover el archivo a la carpeta deseada (por ejemplo, assets/images/profile-img)
                $file->move($this->getParameter('kernel.project_dir') . '/public/uploads/profile-img', $fileName);



                // Actualizar la ruta de la imagen en el usuario
                $user->setProfileImg($fileName);

                try {
                    // Persistir los cambios en la base de datos
                    $em->persist($user);
                    $em->flush();

                    // Respuesta exitosa
                    $data = [
                        'status' => 'success',
                        'code' => Response::HTTP_OK,
                        'message' => 'Profile image updated successfully.',
                    ];
                } catch (\Exception $e) {
                    // Error al guardar los cambios
                    $data['message'] = 'Unable to update profile image.';
                }
            } else {
                // No se proporcionó la imagen en la solicitud
                $data['message'] = 'Image not found in the request.';
            }
        }

        // Crear la respuesta JSON
        $response = new JsonResponse($data, $data['code']);

        return $response;
    }

    public function getProfileImg(Request $request, JwtAuth $jwt_auth)
    {
        // Recoger cabecera de autenticación
        $token = $request->headers->get('Authorization');
        // Crear método para comprobar si el token es correcto
        $authCheck = $jwt_auth->checkToken($token);

        // Respuesta por defecto
        $data = [
            'status' => 'error',
            'code' => Response::HTTP_BAD_REQUEST,
            'message' => 'Invalid request.',
        ];

        // Si el token es correcto, realizar la búsqueda del usuario
        if ($authCheck) {
            // Conseguir el entity manager
            $em = $this->entityManager;

            // Conseguir los datos del usuario autenticado
            $identity = $jwt_auth->checkToken($token, true);

            // Conseguir el usuario por su ID
            $userRepository = $em->getRepository(User::class);
            $user = $userRepository->find($identity->sub);

            // Verificar si se encontró el usuario
            if ($user) {
                // Obtener la ruta de la imagen de perfil
                $profileImg = $user->getProfileImg();

                // Verificar si se ha establecido una imagen de perfil
                if ($profileImg) {
                    // La imagen de perfil existe, devolver la ruta
                    $data = [
                        'status' => 'success',
                        'code' => Response::HTTP_OK,
                        'profile_img' => 'http://localhost:8000/uploads/profile-img/' . $profileImg,
                    ];
                } else {
                    $data = [
                        'status' => 'success',
                        'code' => Response::HTTP_OK,
                        'profile_img' => 'http://localhost:8000/uploads/profile-img/default.png',
                    ];
                }
            } else {
                // No se encontró el usuario
                $data['message'] = 'User not found.';
            }
        }

        // Crear la respuesta JSON
        $response = new JsonResponse($data, $data['code']);

        return $response;
    }




    public function update(Request $request, JwtAuth $jwt_auth)
    {

        //RECOGER CABECERA AUTENTICACION 
        $token = $request->headers->get('Authorization');
        //CREAR METODO PARA COMPROBAR SI EL TOKEN ES CORRECTO 
        $authCheck = $jwt_auth->checkToken($token);

        //respuesta por defecto 
        $data = [
            'status' => 'error',
            'code' => 400,
            'message' => 'Metodo update del controlador usuarios',
        ];

        //SI ES CORRECTO HACER LA ACTUALZIACION DEL USUARIO 
        if ($authCheck) {
            //ACTUALIAR AL USUARIO 

            //CONSEGUIR ENTITY MANAGER
            $em = $this->entityManager;
            //CONSEGUIR LOS DATOS DEL USUARIO AUTENTICADO 
            $identity = $jwt_auth->checkToken($token, true);

            //CONSEGUIR EL USUARIO A ACTUALIZAR COMPLETO 
            $userRepository = $this->entityManager->getRepository(User::class);
            $user = $userRepository->findOneBy([
                'id' => $identity->sub
            ]);

            //RECOGER LOS DATOS POR POST 
            // Recoger el cuerpo de la solicitud
            $json = $request->getContent();
            $params = json_decode($json);


            //COMPROBAR Y VALIDAR LOS DATOS 
            if (!empty($json)) {
                // Validar campos requeridos
                $required_fields = ['nickname', 'nationality', /*'email', 'passwd',*/ 'id_availability', 'id_rank', 'id_ambition', 'id_srole', 'id_trole', 'id_first_character', 'id_second_character', 'id_third_character'];

                foreach ($required_fields as $field) {
                    if (!empty($params->{$field})) {
                        switch ($field) {
                            case 'nickname':
                                $user->setNickname($params->{$field});
                                break;
                            case 'nationality':
                                $user->setNationality($params->{$field});
                                break;
                            case 'email':
                                if (filter_var($params->{$field}, FILTER_VALIDATE_EMAIL)) {
                                    $user->setEmail($params->{$field});
                                } else {
                                    $data['message'] = "El email no es válido";
                                    return $this->resjson($data);
                                }
                                break;
                            case 'passwd':
                                $user->setPasswd(password_hash($params->{$field}, PASSWORD_DEFAULT));
                                break;
                            case 'id_availability':
                                $availabilityRepository = $this->entityManager->getRepository(Availability::class);
                                $user->setIdAvailability($availabilityRepository->find($params->{$field}));
                                break;
                            case 'id_rank':
                                $rankRepository = $this->entityManager->getRepository(Rank::class);
                                $user->setIdRank($rankRepository->find($params->{$field}));
                                break;
                            case 'id_ambition':
                                $ambitionRepository = $this->entityManager->getRepository(Ambition::class);
                                $user->setIdAmbition($ambitionRepository->find($params->{$field}));
                                break;
                            case 'id_srole':
                                $sroleRepository = $this->entityManager->getRepository(SoloRole::class);
                                $user->setIdSrole($sroleRepository->find($params->{$field}));
                                break;
                            case 'id_trole':
                                $troleRepository = $this->entityManager->getRepository(TeamRole::class);
                                $user->setIdTrole($troleRepository->find($params->{$field}));
                                break;
                            case 'id_first_character':
                                $characterRepository = $this->entityManager->getRepository(Character::class);
                                $user->setIdFirstCharacter($characterRepository->find($params->{$field}));
                                break;
                            case 'id_second_character':
                                $characterRepository = $this->entityManager->getRepository(Character::class);
                                $user->setIdSecondCharacter($characterRepository->find($params->{$field}));
                                break;
                            case 'id_third_character':
                                $characterRepository = $this->entityManager->getRepository(Character::class);
                                $user->setIdThirdCharacter($characterRepository->find($params->{$field}));
                                break;
                        }
                    }
                }
            }

            if (!empty($params->age)) {
                $user->setAge(new \DateTime($params->age));
            }


            if (!empty($params->short_description)) {
                $user->setShortDescription($params->short_description);
            }



            //COMPROBAR DUPLICADOS 
            $existingUser = $userRepository->findOneBy(['email' => $user->getEmail()]);
            if ($existingUser && $existingUser->getId() != $user->getId()) {
                $data['message'] = "There is already a user with that email";
                return $this->resjson($data);
            }

            $existingNickname = $userRepository->findOneBy(['nickname' => $user->getNickname()]);
            if ($existingNickname && $existingNickname->getId() != $user->getId()) {
                $data['message'] = "There is already a user with that nickname";
                return $this->resjson($data);
            }

            //GUARDAR CABIOS EN LA BBDD
            $entityManager = $this->entityManager;
            $entityManager->persist($user);
            $entityManager->flush();

            // Cambiar respuesta por defecto a éxito
            $data['status'] = 'success';
            $data['code'] = 200;
            // $data['message'] = 'Los datos del usuario han sido actualizados correctamente.';
            $data['message'] = $params;
        }



        return $this->resjson($data);
    }

    public function contact(Request $request, MailerInterface $mailer)
    {
        // Recibir los datos del formulario
        $jsonData = $request->get('json', null);
        $data = json_decode($jsonData, true);

        // Validar los datos del formulario
        if (empty($data['nombre']) || empty($data['email']) || empty($data['mensaje'])) {
            $response = [
                'status' => 'error',
                'message' => 'Faltan campos obligatorios en el formulario de contacto'
            ];
            return new JsonResponse($response, 400);
        }

        // Crear un mensaje de correo
        $message = (new Email())
            //->from($data['email'])
            ->from('playmatedaw@gmail.com')
            ->to('leonarisadria@gmail.com')
            ->subject('Soporte de ' . $data['email'])
            ->text('Remitente: ' . $data['nombre'] . ' (' . $data['email'] . ')' . "\n\n" . $data['mensaje']);

        // Enviar el mensaje de correo
        $mailer->send($message);

        // Devolver un echo con los datos del formulario
        $response = [
            'status' => 'success',
            'message' => 'Tu mensaje ha sido enviado correctamente',
            'data' => $data
        ];
        return new JsonResponse($response);
    }

    public function logout(TokenStorageInterface $tokenStorage): JsonResponse
    {
        $tokenStorage->setToken(null);

        return new JsonResponse([
            'success' => true,
            'message' => 'Logout successful.'
        ]);
    }

    public function getAllUsers(Request $request, JwtAuth $jwt_auth): Response
    {
        //RECOGER CABECERA AUTENTICACION 
        $token = $request->headers->get('Authorization');
        //CREAR METODO PARA COMPROBAR SI EL TOKEN ES CORRECTO 
        $authCheck = $jwt_auth->checkToken($token);

        //respuesta por defecto 
        $data = [
            'status' => 'error',
            'code' => 400,
            'message' => 'Metodo getAllUsers del controlador usuarios',
        ];

        //SI ES CORRECTO HACER LA ACTUALZIACION DEL USUARIO 
        if ($authCheck) {
            $page = $request->query->get('page', 1); // Default a 1
            $pageSize = $request->query->get('pageSize', 12); // Default a 12
            $filters = json_decode($request->query->get('filters', '{}'), true); // Default a un objeto vacío

            $entityManager = $this->entityManager;
            $queryBuilder = $entityManager->createQueryBuilder();

            $queryBuilder
                ->select('u', 'c1', 'c2', 'c3', 'r', 'sr', 'tr', 'a', 'av')
                ->from(User::class, 'u')
                ->innerJoin('u.idFirstCharacter', 'c1')
                ->innerJoin('u.idSecondCharacter', 'c2')
                ->innerJoin('u.idThirdCharacter', 'c3')
                ->innerJoin('u.idRank', 'r')
                ->innerJoin('u.idSrole', 'sr')
                ->innerJoin('u.idTrole', 'tr')
                ->innerJoin('u.idAmbition', 'a')
                ->innerJoin('u.idAvailability', 'av');

            // Aplicar los filtros
            if (!empty($filters['nationality'])) {
                $queryBuilder->andWhere('u.nationality = :nationality')
                    ->setParameter('nationality', $filters['nationality']);
            }

            if (!empty($filters['availability'])) {
                $queryBuilder->andWhere('u.idAvailability = :availability')
                    ->setParameter('availability', $filters['availability']);
            }


            if (!empty($filters['character'])) {
                $queryBuilder->andWhere('u.idFirstCharacter = :character 
                OR u.idSecondCharacter = :character 
                OR u.idThirdCharacter = :character')
                    ->setParameter('character', $filters['character']);
            }

            if (!empty($filters['sRole'])) {
                $queryBuilder->andWhere('u.idSrole = :sRole')
                    ->setParameter('sRole', $filters['sRole']);
            }

            if (!empty($filters['tRole'])) {
                $queryBuilder->andWhere('u.idTrole = :tRole')
                    ->setParameter('tRole', $filters['tRole']);
            }

            if (!empty($filters['rank'])) {
                $queryBuilder->andWhere('u.idRank = :rank')
                    ->setParameter('rank', $filters['rank']);
            }


            // Primero, calculamos el número total de usuarios
            $totalUsers = clone $queryBuilder;
            $totalUsers = $totalUsers
                ->select('count(u.id)')
                ->getQuery()
                ->getSingleScalarResult();

            // Calculamos el número total de páginas
            $totalPages = ceil($totalUsers / $pageSize);

            $queryBuilder
                ->setMaxResults($pageSize)
                ->setFirstResult(($page - 1) * $pageSize);

            $users = $queryBuilder->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            // Devolvemos la información de los usuarios junto con la información de la paginación
            return $this->json([
                'data' => $users,
                'totalPages' => $totalPages,
                'currentPage' => $page,
            ]);
        }
        return $this->json($data);
    }

    public function getUserByToken(Request $request, JwtAuth $jwt_auth)
    {

        //RECOGER CABECERA AUTENTICACION 
        $token = $request->headers->get('Authorization');
        //CREAR METODO PARA COMPROBAR SI EL TOKEN ES CORRECTO 
        $authCheck = $jwt_auth->checkToken($token);

        if ($authCheck) {
            //ACTUALIAR AL USUARIO 

            //CONSEGUIR ENTITY MANAGER
            $em = $this->entityManager;
            //CONSEGUIR LOS DATOS DEL USUARIO AUTENTICADO 
            $identity = $jwt_auth->checkToken($token, true);

            //CONSEGUIR EL USUARIO A ACTUALIZAR COMPLETO 
            $userRepository = $this->entityManager->getRepository(User::class);
            $user = $userRepository->findOneBy([
                'id' => $identity->sub
            ]);
        };


        return $this->resjson($user);
    }

    public function getUserById(Request $request, $id, JwtAuth $jwt_auth): Response
{
    //RECOGER CABECERA AUTENTICACION 
    $token = $request->headers->get('Authorization');
    //CREAR METODO PARA COMPROBAR SI EL TOKEN ES CORRECTO 
    $authCheck = $jwt_auth->checkToken($token);

    //respuesta por defecto 
    $data = [
        'status' => 'error',
        'code' => 400,
        'message' => 'Metodo getUserById del controlador usuarios',
    ];

    //SI ES CORRECTO HACER LA ACTUALZIACION DEL USUARIO 
    if ($authCheck) {
        $entityManager = $this->entityManager;
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder
            ->select('u', 'c1', 'c2', 'c3', 'r', 'sr', 'tr', 'a', 'av')
            ->from(User::class, 'u')
            ->innerJoin('u.idFirstCharacter', 'c1')
            ->innerJoin('u.idSecondCharacter', 'c2')
            ->innerJoin('u.idThirdCharacter', 'c3')
            ->innerJoin('u.idRank', 'r')
            ->innerJoin('u.idSrole', 'sr')
            ->innerJoin('u.idTrole', 'tr')
            ->innerJoin('u.idAmbition', 'a')
            ->innerJoin('u.idAvailability', 'av')
            ->where('u.id = :id')
            ->setParameter('id', $id);

        $user = $queryBuilder->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        // Devolvemos la información del usuario
        return $this->json([
            'data' => $user,
        ]);
    }
    return $this->json($data);
}


    
}
