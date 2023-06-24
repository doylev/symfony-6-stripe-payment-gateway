<?php

namespace App\Controller;

use App\Service\BubbleService;
use App\Service\CognitoClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Stripe;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TestFormController extends AbstractController
{

    private BubbleService $bubbleService;

    public function __construct(BubbleService $bubbleService)
    {
        $this->bubbleService = $bubbleService;
    }
    
    //    #[Route('/cognito', name: 'app_test')]
//    public function cognito(CognitoClient $cognitoClient): Response
//    {
//        $cognitoClient->GetCognitoClient();
//        return $this->render('test_form/index.html.twig', [
//            'service_name' => 'TestFormService',
//        ]);
//
//    }

    #[Route('/test/index2', name: 'app_test_info')]
    public function index2(): Response
    {
        return $this->render('test_form/index2.html.twig', [
            'controller_name' => 'TestFormController',
        ]);
    }

    #[Route('/test/form', name: 'app_test_form')]
    public function index(BubbleService $bubbleService): Response
    {
        $saleId = '1683482460049x843612956917497900';

        $saleObj = $this->bubbleService->getSalesById($saleId);
        $subscriberId = $saleObj["User Subscriber"];
//          dd($subscriberId);
        $subscriberObj = $bubbleService->getSubscriberById($subscriberId);
        dd($subscriberObj);
//
//        Stripe\Stripe::setApiKey($_ENV["STRIPE_SECRET"]);
//
//        $stripe = new \Stripe\StripeClient($_ENV["STRIPE_SECRET"]);
//
//        $setupintent = $stripe->setupIntents->create ([
//            "customer" => "cus_N4xF6rjfxphy6F",
//            "payment_method_types" => ['card']
//        ]);
//
//        $setupintent = $stripe->setupIntents->retrieve(
//            'seti_1MVM46FAcXEtaho5CvWaMhYh'
//        );
//        $setupintent = $setupintent->cancel();
//        dd($setupintent);
        return $this->render('test_form/index.html.twig', [
            'service_name' => 'TestFormService',
            'saleObj' => $saleObj,
        ]);
    }
}
