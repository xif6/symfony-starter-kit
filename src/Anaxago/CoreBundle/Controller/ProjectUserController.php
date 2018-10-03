<?php

namespace Anaxago\CoreBundle\Controller;

use Anaxago\CoreBundle\AnaxagoCoreBundle;
use Anaxago\CoreBundle\Entity\Project;
use Anaxago\CoreBundle\Entity\ProjectUser;
use Anaxago\CoreBundle\Form\Type\ProjectUserType;
use Doctrine\DBAL\DBALException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Project controller.
 *
 * @Route("myproject")
 */
class ProjectUserController extends Controller
{
    /**
     * @Route("/", name="my_project_index")
     * @Method("GET")
     */
    public function indexAction(SerializerInterface $serializer)
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('AnaxagoCoreBundle:Project')->findByInvestor($this->getUser());

        $projects = $serializer->serialize($projects, 'json', ['groups' => ['investor']]);

        return new JsonResponse($projects, 200, [], true);
    }

    /**
     * @Route("/{id}", name="my_project_add")
     * @ParamConverter("project", class="AnaxagoCoreBundle:Project")
     * @Method("POST")
     */
    public function addAction(Request $request, SerializerInterface $serializer, Project $project)
    {
        $projectUser = new ProjectUser();
        try {
            $projectUser
                ->setInvestor($this->getUser())
                ->setAmount($request->get('amount'))
                ->setProject($project);
            $em = $this->getDoctrine()->getManager();
            $em->persist($projectUser);
            $em->flush();
        } catch (DBALException $e) {
            return new JsonResponse(['error' => 'error insert DB'], 500);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }

        $projectUser = $serializer->serialize($projectUser, 'json', ['groups' => ['investor']]);
        return new JsonResponse($projectUser, 200, [], true);
    }
}
