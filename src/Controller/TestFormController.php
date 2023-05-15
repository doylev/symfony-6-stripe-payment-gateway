<?php

namespace App\Controller;

use App\Service\CognitoClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Stripe;

class TestFormController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function default(BubbleController $bubbleController): Response
    {
        return $this->render('test_form/index.html.twig', [
            'controller_name' => 'TestFormController',
        ]);

    }

//    #[Route('/cognito', name: 'app_test')]
//    public function cognito(CognitoClient $cognitoClient): Response
//    {
//        $cognitoClient->GetCognitoClient();
//        return $this->render('test_form/index.html.twig', [
//            'controller_name' => 'TestFormController',
//        ]);
//
//    }

    #[Route('/test/form', name: 'app_test_form')]
    public function index(BubbleController $bubbleController): Response
    {
        $saleId = '1683482460049x843612956917497900';

//        $bubbleController->getAllUsers();
//          $user = $bubbleController->getUserById('1669997103592x427232129968259500');
        $saleObj = $bubbleController->getSalesById($saleId);
        $subscriberId = $saleObj["User Subscriber"];
//          dd($subscriberId);
        $subscriberObj = $bubbleController->getSubscriberById($subscriberId);
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
            'controller_name' => 'TestFormController',
            'saleObj' => $saleObj,
        ]);
    }
}
