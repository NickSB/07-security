<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Offen = 'offen';
    case Aktiv = 'aktiv';
    case Abgeschlossen = 'abgeschlossen';

    public function label(): string
    {
        return match ($this) {
            self::Offen => 'Offen',
            self::Aktiv => 'Aktiv',
            self::Abgeschlossen => 'Abgeschlossen',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Offen => 'bg-gray-100 text-gray-700',
            self::Aktiv => 'bg-emerald-100 text-emerald-800',
            self::Abgeschlossen => 'bg-blue-100 text-blue-800',
        };
    }
}
