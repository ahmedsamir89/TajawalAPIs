<?php


namespace App\Controller;


use App\Form\HotelSearchType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HotelAPIController
 * @package App\Controller
 * @Rest\Route("/api")
 */
class HotelAPIController extends FOSRestController
{
    /**
     * @Rest\Get("/hotels")
     * @param Request $request
     * @return JsonResponse
     */
    public function hotelsAction(Request $request)
    {
        $searchForm = $this->createForm(HotelSearchType::class);
        $searchForm->submit($request->query->all());

        if($searchForm->isValid()) {
            $searchOptions = $searchForm->getData();
            $result = $this->get('app.service.hotel')->search($searchOptions);
            return new JsonResponse([
                'success' => true,
                'hotels' => $result
            ]);
        }

        $errors = $this->get('app.service.form.error.handler')->getFormErrorsAsArray($searchForm);
        return new JsonResponse([
            'success' => false,
            'errors' => $errors
        ], Response::HTTP_BAD_REQUEST);
    }
}