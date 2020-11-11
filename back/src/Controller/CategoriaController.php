<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categoria;

class CategoriaController extends AbstractController
{
    /**
     * @Route("/categoria-listar", name="categoria_index", methods={"GET"})
     */
    public function index(SerializerInterface $serializer): Response
    {

        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository(Categoria::class)->findAll();
        $jsonCategorias = $serializer->serialize(
            $categorias,
            'json'
        );

        return $this->json([
            $jsonCategorias,
        ]);
    }

    /**
     * @Route("/categoria-inserir", name="categoria_inserir", methods={"POST"})
     */
    public function new(Request $request): Response
    {

        $em = $this->getDoctrine()->getManager();

        $params = json_decode($request->getContent());

        $categoria = new Categoria();
        $categoria->setCategoria($params->categoria);
        $em->persist($categoria);
        $em->flush();

        return $this->json([
            'id_categoria' => $categoria->getId(),
        ]);
    }
}
