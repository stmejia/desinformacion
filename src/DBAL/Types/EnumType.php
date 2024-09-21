<?php

namespace App\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class EnumType extends Type
{
    const ENUM = 'enum'; 

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return "ENUM('desmentido', 'no verificable', 'en investigación')"; 
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?string
    {
        return $value; 
    }

    public function getName(): string
    {
        return self::ENUM;
    }
}