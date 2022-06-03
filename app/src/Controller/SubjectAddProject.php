<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Entity\Challenge;
use App\Entity\SubjectProject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Custom\Challenge\ChallengeCustom;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SubjectAddProject
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request, Subject $data)
    {
        $params = json_decode($request->getContent(), true);

        $params = is_array($params) ? $params : [$params];

        foreach($params as $projectId) {
            if (!$data->hasProjectId($projectId)) {
                $subjectProject = new SubjectProject();
                $subjectProject->setProjectId($projectId);

                $this->entityManager->persist($subjectProject);
                
                $data->addProject($subjectProject);
            }
        }

        $this->entityManager->flush();

        return new JsonResponse('OK', Response::HTTP_OK);
    }
}