<?php

namespace App\Service;

use MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Arr;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class NormalizeService
{

    public function __construct(
        private ContainerBagInterface $params,
    ) {
    }

    public function normalize(string $role): array
    {

        $roleMap = [] ;
        foreach($this->params->get('app.user_types') as $type){
            $roleMap[$type]  = 'ROLE_' . strtoupper($type);
        }

        return $roleMap?? $role; 
    }
}
