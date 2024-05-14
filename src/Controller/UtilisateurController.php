<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Entity\Prestataire;
use App\Repository\PrestataireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use App\Service\FileUploader;



class UtilisateurController extends AbstractController
{
    #[Route('/utilisateurs', name: 'utilisateur_list', methods: ['GET'])]
    public function list(ManagerRegistry $doctrine): Response
    {
        $utilisateurs = $doctrine->getRepository(Utilisateur::class)->findAll();
        return $this->json($utilisateurs);
    }

    #[Route('/utilisateur/{id}', name: 'utilisateur_show', methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $utilisateur = $doctrine->getRepository(Utilisateur::class)->find($id);
        if (!$utilisateur) {
            return $this->json(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($utilisateur);
    }

    #[Route('/utilisateur/email/{email}', name: 'utilisateur_by_email', methods: ['GET'])]

    public function getByEmail(ManagerRegistry $doctrine, string $email): Response
    {
        $utilisateur = $doctrine->getRepository(Utilisateur::class)->findOneBy(['email' => $email]);

        if (!$utilisateur) {
            return $this->json(['message' => 'Utilisateur avec cet email non trouvé'], Response::HTTP_NOT_FOUND);
        }


        return $this->json([
            'id' => $utilisateur->getId(),
            'nom' => $utilisateur->getNom(),
            'prenom' => $utilisateur->getPrenom(),
            'email' => $utilisateur->getEmail(),
            'typeUtilisateur' => $utilisateur->getTypeUtilisateur(),

        ]);
    }

    #[Route('/utilisateur', name: 'utilisateur_new', methods: ['POST'])]
    public function new(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $hasher): Response
    {
        $entityManager = $doctrine->getManager();
        $utilisateur = new Utilisateur();
    
        // Handling the file upload
        $file = $request->files->get('photoProfil');
        if ($file) {
            $utilisateur->setImageFile($file);
        }
    
        // Handling other data
        $data = json_decode($request->getContent(), true);
        $utilisateur->setEmail($data['email'] ?? null);
        $utilisateur->setNom($data['nom'] ?? null);
        $utilisateur->setPrenom($data['prenom'] ?? null);
        $hashedPassword = $hasher->hashPassword($utilisateur, $data['motDePasse'] ?? '');
        $utilisateur->setPassword($hashedPassword);
        $utilisateur->setTypeUtilisateur($data['typeUtilisateur'] ?? null);
        $utilisateur->setDateNaissance(new \DateTime($data['dateNaissance'] ?? 'now'));
        $utilisateur->setLanguesParlees($data['languesParlees'] ?? null);
        $utilisateur->setUsername($data['username'] ?? null);
    
        // This update timestamp is required to trigger the lifecycle callbacks
        $utilisateur->setUpdatedAt(new \DateTimeImmutable());
    
        // Persist and flush
        $entityManager->persist($utilisateur);
        $entityManager->flush();
    
        return $this->json($utilisateur, Response::HTTP_CREATED);
    }
    
    


    #[Route('/utilisateur/{id}', name: 'utilisateur_edit', methods: ['PUT'])]
    public function edit(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($id);

        if (!$utilisateur) {
            return $this->json(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $utilisateur->setNom($data['nom']);

        $entityManager->flush();
        return $this->json($utilisateur);
    }

    #[Route('/utilisateur/{id}', name: 'utilisateur_delete', methods: ['DELETE'])]
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($id);

        if (!$utilisateur) {
            return $this->json(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($utilisateur);
        $entityManager->flush();
        return $this->json(['message' => 'Utilisateur supprimé'], Response::HTTP_OK);
    }

    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $hasher, JWTTokenManagerInterface $JWTManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $plainPassword = $data['motDePasse'];

        $utilisateur = $doctrine->getRepository(Utilisateur::class)->findOneBy(['email' => $email]);

        if (!$utilisateur || !$hasher->isPasswordValid($utilisateur, $plainPassword)) {
            return $this->json(['message' => 'Email or password is incorrect'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        // Generate JWT Token with email field
        return new JsonResponse(['token' => $JWTManager->create($utilisateur, ['email' => $utilisateur->getEmail()])]);
    }

    #[Route('/utilisateurs/prenom/{prenom}', name: 'utilisateur_by_prenom', methods: ['GET'])]
    public function getByPrenom(ManagerRegistry $doctrine, string $prenom): Response
    {
        $utilisateurs = $doctrine->getRepository(Utilisateur::class)->findBy(['prenom' => $prenom]);

        if (!$utilisateurs) {
            return $this->json(['message' => 'Aucun utilisateur trouvé avec ce prénom'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($utilisateurs);
    }

    #[Route('/prestataire', name: 'prestataire_new', methods: ['POST'])]
    public function createPrestataire(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $hasher): Response
    {
        $data = json_decode($request->getContent(), true);
        $entityManager = $doctrine->getManager();

        $prestataire = new Prestataire();
        $prestataire->setNomEntreprise($data['nomEntreprise']);
        $prestataire->setNomPrestataire($data['nomPrestataire']);
        $prestataire->setTypeService($data['typeService']);
        $prestataire->setCompetences($data['competences']);
        $prestataire->setPortfolio($data['portfolio'] ?? null);
        $prestataire->setDescription($data['description'] ?? null);
        $prestataire->setEmail($data['email']); 

        $hashedPassword = $hasher->hashPassword($prestataire, $data['motDePasse']);
        $prestataire->setPassword($hashedPassword);


        $prestataire->setSiret($data['siret']);
        $prestataire->setPrenom($data['prenom']);
        $prestataire->setPseudo($data['pseudo']);
        $prestataire->setDisponible($data['disponible']);
        $prestataire->setDateDisponibilite(new \DateTime($data['dateDisponibilite'] ?? 'now'));

        $entityManager->persist($prestataire);
        $entityManager->flush();

        return $this->json($prestataire, Response::HTTP_CREATED);
    }

    /**
     * @method Prestataire[] searchPrestataires(string $query)
     * @extends ServiceEntityRepository<Prestataire>
     */
    #[Route('/login/prestataire', name: 'login_prestataire', methods: ['POST'])]
    public function loginPrestataire(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $hasher, JWTTokenManagerInterface $JWTManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $plainPassword = $data['motDePasse'];

        $prestataire = $doctrine->getRepository(Prestataire::class)->findOneBy(['email' => $email]);

        if ($prestataire && $hasher->isPasswordValid($prestataire, $plainPassword)) {
            $token = $JWTManager->create($prestataire);
            return new JsonResponse(['token' => $token]);
        } else {
            return $this->json(['message' => 'Email or password is incorrect'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        // Generate JWT Token
        return new JsonResponse(['token' => $JWTManager->create($prestataire)]);
    }

    #[Route('/prestataires/search', name: 'prestataires_search', methods: ['GET'])]
    public function searchPrestataires(Request $request, ManagerRegistry $doctrine): Response
    {
        $query = $request->query->get('query');

        // Search by nickname, type of service or expertise
        $prestataires = $doctrine->getRepository(Prestataire::class)->searchPrestataires($query);
        return $this->json($prestataires);
    }
}
