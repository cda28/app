<?php

namespace App\Enum;

enum Status: string
{
    case DRAFT = 'draft';         // Le cours est en brouillon
    case PUBLISHED = 'published'; // Le cours est publié
    case ARCHIVED = 'archived';   // Le cours est archivé
    case IN_PROGRESS = 'in_progress'; // Le cours est en cours d'exécution
    case COMPLETED = 'completed'; // Le cours est terminé
    case DELETED = 'deleted'; // soft delete pour récupérer les données 
}