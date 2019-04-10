<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Utils\PaymentUtils;
use App\Entity\Demande;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use App\Manager\SessionManager;
use App\Manager\DemandeManager;
use App\Manager\TransactionManager;
use Symfony\Component\HttpFoundation\Cookie;

class PaymentController extends AbstractController
{
    /**
     * @Route("/demande/{demande}/payment", name="payment_demande")
     */
    public function index(Demande $demande)
    {
        
        return $this->render(
            "payment/index.html.twig", 
            ['demande' => $demande]
        );
    }

    /**
     * @Route("/payment/request/{demande}", name="payment_request")
     */
    public function request(
        Demande $demande, 
        PaymentUtils $paymentUtils, 
        ParameterBagInterface $parameterBag, 
        DemandeManager $demandeManager, 
        TransactionManager $transactionManager
    )
    {
        $taxes = $demande->getCommande()->getTaxes()->getTaxeTotale();
        $email = $this->getUser()->getEmail();
        $demandeManager->checkPayment($demande);
        $idTransaction = $transactionManager->generateIdTransaction($demande->getTransaction());
        $taxes *=100;
        $paramDynamical = [
            'amount' => $taxes,
            'customer_email' => $email,
            'transaction_id' => $idTransaction,
        ];
        $param = $parameterBag->get('payment_params');
        $bin   = $parameterBag->get('payment_binary');
        $param = array_merge($param, $paramDynamical);
        
        return new Response($paymentUtils->request($param, $bin));
    }

    /**
     * @Route("/payment/ipn", name="instant_payment_notification")
     */
    public function notification(Request $request, SessionManager $sessionManager, \Swift_Mailer $mailer)
    {
        $sessionManager->initSession();
        $sessionManager->addArraySession("payment", ["mandeha"]);
        $sessionManager->addArraySession("dump", [$request]);


        $message = (new \Swift_Message('Hello Email'))
        ->setFrom('send@example.com')
        ->setTo('recipient@example.com')
        ->setBody(
            $this->renderView(
                // templates/emails/registration.html.twig
                'email/registration.html.twig',
                array('name' => 'papat')
            ),
            'text/html'
        );

        $mailer->send($message);
        
        return new Response('ok');
    }
}
