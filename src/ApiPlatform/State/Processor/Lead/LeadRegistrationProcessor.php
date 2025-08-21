<?php

declare(strict_types=1);

namespace App\ApiPlatform\State\Processor\Lead;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class LeadRegistrationProcessor implements ProcessorInterface
{
    private const AUTH_TOKEN = 'FtSnqpNImRxYdHBxsehyHHCePbDcCOsptF3s4qkYDcRRHvH3veq8w8n1wKLKn0vV6LRgyZsF82BpA0kv2iFYIiPYup0f2PyZ8OH9DEYLwPIWbe2M8R3rzc2CBsiGTnwk';

    public function __construct(
        private ProcessorInterface $persistProcessor,
        private RequestStack $requestStack
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $request = $this->requestStack->getCurrentRequest();
        $authHeader = $request?->headers->get('Authorization');

        if ($authHeader !== self::AUTH_TOKEN) {
            throw new UnauthorizedHttpException('Token realm="API"', 'Not authorized.');
        }

        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }
}
