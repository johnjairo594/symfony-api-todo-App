<?php

namespace src\Application\Listeners;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class JsonExceptionResponseTransformerListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if($exception instanceof HttpException) {
            $data = [
                'class' => get_class($exception),
                'code' => $exception->getStatusCode(),
                'message' => $exception->getMessage()
            ];

            $event->setResponse($this->prepareResponse($data, $data['code']));
        }
    }

    private function prepareResponse(array $data, int $statusCode): JsonResponse
    {
        $response = new JsonResponse($data, $statusCode);
        $response->headers->set('Server-time', time());
        $response->headers->set('X-Error-Code', $statusCode);

        return $response;
    }
}