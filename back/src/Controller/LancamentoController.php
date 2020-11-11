<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categoria;
use App\Entity\Lancamento;

class LancamentoController extends AbstractController
{
    /**
     * @Route("/lancamento-listar", name="lancamento_index", methods={"GET"})
     */
    public function index(SerializerInterface $serializer): Response
    {
        $em = $this->getDoctrine()->getManager();
        $lancamentos = $em->getRepository(Lancamento::class)->findAll();
        $jsonLancamentos = $serializer->serialize(
            $lancamentos,
            'json'
        );

        return $this->json([
            $jsonLancamentos,
        ]);
    }

    /**
     * @Route("/lancamento-inserir", name="lancamento_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $params = json_decode($request->getContent());

        $categoria = $em->getRepository(Categoria::class)->find($params->idcategoria);

        if (!$categoria) {
            return $this->json([
                'Categoria não encontrada',
            ], Response::HTTP_NOT_FOUND);
        }

        $lancamento = new Lancamento();
        $lancamento->setCategoria($categoria)
            ->setTipo($params->tipo)
            ->setDescricao($params->descricao)
            ->setValor($params->valor)
            ->setDatahora(new \DateTime());

        $em->persist($lancamento);
        $em->flush();

        return $this->json([
            $lancamento->getId(),
        ], Response::HTTP_CREATED);
    }

    /**
     * @Route("/lancamento-atualiza/{id}", name="lancamento_update", methods={"PUT"})
     */
    public function update(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();

        $params = json_decode($request->getContent());

        $categoria = $em->getRepository(Categoria::class)->find($params->idcategoria);

        if (!$categoria) {
            return $this->json([
                'Categoria não encontrada',
            ], Response::HTTP_NOT_FOUND);
        }

        $lancamento = $em->getRepository(Lancamento::class)->find($id);

        if (!$lancamento) {
            return $this->json([
                'Lançamento não encontrado',
            ], Response::HTTP_NOT_FOUND);
        }

        $lancamento->setCategoria($categoria)
            ->setTipo($params->tipo)
            ->setDescricao($params->descricao)
            ->setValor($params->valor)
            ->setDatahora(new \DateTime());

        $em->persist($lancamento);
        $em->flush();

        return $this->json([
            $lancamento->getId(),
        ]);
    }

    /**
     * @Route("/lancamento-deleta/{id}", name="lancamento_delete", methods={"DELETE"})
     */
    public function delete($id): Response
    {
        $em = $this->getDoctrine()->getManager();

        $lancamento = $em->getRepository(Lancamento::class)->find($id);

        if (!$lancamento) {
            return $this->json([
                'Lançamento não encontrado',
            ], Response::HTTP_NOT_FOUND);
        }

        $em->remove($lancamento);
        $em->flush();

        return $this->json([
            'Lançamento deletado com sucesso',
        ], Response::HTTP_NO_CONTENT);
    }
}
