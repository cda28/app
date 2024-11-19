<?php

namespace App\Enum;

enum Presence: string
{
    case ONLINE = 'online';
    case OFFLINE = 'offline';
    case IN_PERSON = 'in_person';
    case BUSY = 'busy';          // Pour indiquer que l'utilisateur est occupé
    case INVISIBLE = 'invisible'; // Pour indiquer que l'utilisateur est connecté mais ne souhaite pas être visible
}