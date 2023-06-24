<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Stripe;

class StripeController extends AbstractController
{
    #[Route('/stripe', name: 'app_stripe', methods: ['GET'])]
    public function index(): Response
    {
        Stripe\Stripe::setApiKey($_ENV["STRIPE_SECRET"]);

        $stripePaymentIntent = new \Stripe\PaymentIntent([
            'amount' => 500,
            'currency' => 'usd',
        ])
        return $this->render('stripe/index.html.twig', [
            'stripe_key' => $_ENV["STRIPE_KEY"],
            'client_secret' => $stripePaymentIntent->client_secret,
        ]);
    }

    #[Route('/stripe/checkout', name: 'app_stripe_checkout', methods: ['GET'])]
    public function createCheckout(Request $request)
    {

        Stripe\Stripe::setApiKey($_ENV["STRIPE_SECRET"]);

        $stripe = new \Stripe\StripeClient($_ENV["STRIPE_SECRET"]);

        $checkoutSession = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price' => 'price_1MHHczFAcXEtaho5GI8FvyGb',
                    'quantity' => '1',
                ],
            ],
            'cancel_url' => 'https://test/index2',
            'customer' => 'cus_N4xF6rjfxphy6F',
            'mode' => 'subscription',
            'success_url' => 'https://test/index2',
        ]);
        dd($checkoutSession);
        return $this->redirect($checkoutSession->url);
    }

    #[Route('/stripe/create-charge', name: 'app_stripe_charge', methods: ['POST'])]
    public function createCharge(Request $request)
    {
        dd('In createCharge');
        Stripe\Stripe::setApiKey($_ENV["STRIPE_SECRET"]);
        Stripe\Charge::create([
            "amount" => 5 * 100,
            "currency" => "usd",
            "source" => $request->request->get('stripeToken'),
            "description" => "Binaryboxtuts Payment Test"
        ]);
        $this->addFlash(
            'success',
            'Payment Successful!'
        );
        return $this->redirectToRoute('app_stripe', [], Response::HTTP_SEE_OTHER);
    }
}
