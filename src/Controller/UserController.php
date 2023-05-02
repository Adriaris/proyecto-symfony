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
                    $data['message'] = "El campo '$field' es requerido";
                    //$data['pruebas'] = $params;
                    return $this->resjson($data);
                }
            }

            // Validar email
            if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
                $data['message'] = "El email no es válido";
                return $this->resjson($data);
            }

            // Comprobar si ya existe un usuario con ese email
            $userRepository = $this->entityManager->getRepository(User::class);
            $existingUser = $userRepository->findOneBy(['email' => $params['email']]);
            if ($existingUser) {
                $data['message'] = "Ya existe un usuario con ese email";
                return $this->resjson($data);
            }

            // Comprobar si ya existe un usuario con ese nickname
            $existingNickname = $userRepository->findOneBy(['nickname' => $params['nickname']]);
            if ($existingNickname) {
                $data['message'] = "Ya existe un usuario con ese nickname";
                return $this->resjson($data);
            }

            // Validar fecha de nacimiento
            if (!empty($params['age']) && !\DateTime::createFromFormat('Y-m-d', $params['age'])) {
                $data['message'] = "La fecha de nacimiento no es válida";
                return $this->resjson($data);
            }

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
            //$user->setIdRank($params['id_rank']);
            //$user->setIdAmbition($params['id_ambition']);
            //$user->setIdSrole($params['id_srole']);
            //$user->setIdTrole($params['id_trole']);

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
            //$user->setIdSecondCharacter($characterRepository->find($params['id_second_character']));
            $user->setIdSecondCharacter($characterRepository->find($params['id_second_character']));
            $user->setIdThirdCharacter($characterRepository->find($params['id_third_character']));

            // Guardar usuario en la base de datos
            $entityManager = $this->entityManager;
       
            $entityManager->persist($user);
            $entityManager->flush();

            // Cambiar respuesta por defecto
            $data['status'] = 'success';
            $data['code'] = '201';
            $data['message'] = 'El usuario ha sido creado correctamente';
        }} catch (Exception $e) {
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
            $json = $request->get('json', null);
            $params = json_decode($json);

            //COMPROBAR Y VALIDAR LOS DATOS 
            if (!empty($json)) {
                // Validar campos requeridos
                $required_fields = ['nickname', 'nationality', 'email', 'passwd', 'id_availability', 'id_rank', 'id_ambition', 'id_srole', 'id_trole', 'id_first_character', 'id_second_character', 'id_third_character'];

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

            //COMPROBAR DUPLICADOS 
            $existingUser = $userRepository->findOneBy(['email' => $user->getEmail()]);
            if ($existingUser && $existingUser->getId() != $user->getId()) {
                $data['message'] = "Ya existe un usuario con ese email";
                return $this->resjson($data);
            }

            $existingNickname = $userRepository->findOneBy(['nickname' => $user->getNickname()]);
            if ($existingNickname && $existingNickname->getId() != $user->getId()) {
                $data['message'] = "Ya existe un usuario con ese nickname";
                return $this->resjson($data);
            }

            //GUARDAR CABIOS EN LA BBDD
            $entityManager = $this->entityManager;
            $entityManager->persist($user);
            $entityManager->flush();

            // Cambiar respuesta por defecto a éxito
            $data['status'] = 'success';
            $data['code'] = 200;
            $data['message'] = 'Los datos del usuario han sido actualizados correctamente.';
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
            ->subject('Soporte de '.$data['email'])
            ->text('Remitente: '.$data['nombre'].' ('.$data['email'].')'."\n\n".$data['mensaje']);
    
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

    /*public function getAllUsers(): JsonResponse
    {
       /* $userRepository = $this->entityManager->getRepository(User::class);
        $users = $userRepository->findAll();
        return $this->json($users);
    }*/

    public function getAllUsers(): Response
    {
        $entityManager = $this->entityManager;
    
        $users = $entityManager->createQueryBuilder()
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
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    
        return $this->json($users);
    }
    

    


};
