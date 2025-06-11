<?php

namespace App\Enums;

enum DepartmentsEnum : string
{
    case Administration = "Administration";
    case InformationTechnology = "Information Technology";
    case Marketing = "Marketing";
    case PublicRelations = "Public Relations";



    public function label(): string
    {
        return match($this) {
            self::Administration => 'Administracja',
            self::InformationTechnology => 'IT',
            self::Marketing => 'Marketing',
            self::PublicRelations => 'PR',
        };
    }

}

