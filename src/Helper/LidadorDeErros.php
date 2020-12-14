<?php
namespace App\Helper;

use App\Helper\ResponseFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LidadorDeErros implements EventSubscriberInterface
{
    public $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION=>[
                ['handle404Exception', -1],
                
                // Pega todas as Exception, desabilitado pelo log do console não estar funcionando
                //['handleGenericException', 0]
        ]];
    }
    public function handle404Exception(ExceptionEvent $event)
    {
        if ($event->getThrowable()instanceof NotFoundHttpException)
        {
            $this->logger->critical('Uma exceção ocorreu. {stack}', ['stack'=> $event->getThrowable()->getTraceAsString()]);
            $response = ResponseFactory::Erro($event->getThrowable());
            $event->setResponse($response->getResponse());
        }
    }
    function handleGenericException(ExceptionEvent $event)
    {
        $this->logger->critical('Uma exceção ocorreu. {stack}', ['stack'=> $event->getThrowable()->getTraceAsString()]);
        $response = ResponseFactory::Erro($event->getThrowable());
        $event->setResponse($response->getResponse());
    }
    

}
