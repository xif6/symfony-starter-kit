<?php

namespace Anaxago\CoreBundle\Controller;

use Anaxago\CoreBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Project controller.
 *
 * @Route("project")
 */
class ProjectController extends Controller
{
    /**
     * @Route("/", name="project_index")
     * @Method("GET")
     */
    public function indexAction(SerializerInterface $serializer)
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('AnaxagoCoreBundle:Project')->findAll();

        $projects = $serializer->serialize($projects, 'json', ['groups' => ['anonymous']]);

        return new JsonResponse($projects, 200, [], true);
    }

    /**
     * @Route("/funded", name="project_funded")
     * @Method("GET")
     */
    public function fundedAction(SerializerInterface $serializer)
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('AnaxagoCoreBundle:Project')->findFounded();

        $projects = $serializer->serialize($projects, 'json', ['groups' => ['anonymous']]);

        return new JsonResponse($projects, 200, [], true);
    }

    /**
     * @Route("/unfunded", name="project_unfunded")
     * @Method("GET")
     */
    public function unfundedAction(SerializerInterface $serializer)
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('AnaxagoCoreBundle:Project')->findUnfounded();

        $projects = $serializer->serialize($projects, 'json', ['groups' => ['anonymous']]);

        return new JsonResponse($projects, 200, [], true);
    }
}
