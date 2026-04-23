<?php

namespace App\Helpers;

trait HasDefault
{
    protected static function bootHasDefault()
    {
        static::creating(function ($model) {
            $defaultColumns = self::getDefaultValueColumn()["creating"] ?? null;
            if ($defaultColumns) {
                $defaultValues = self::getValueOfDefaultColumn();
                foreach ($defaultColumns as $column) {
                    if (array_key_exists($column, $defaultValues)) {
                        $model->$column = $defaultValues[$column];
                    }
                }
            }
        });

        static::updating(function ($model) {
            $defaultColumns = self::getDefaultValueColumn()["updating"] ?? null;
            if ($defaultColumns) {
                $defaultValues = self::getValueOfDefaultColumn();
                foreach ($defaultColumns as $column) {
                    if (array_key_exists($column, $defaultValues)) {
                        $model->$column = $defaultValues[$column];
                    }
                }
            }
        });
    }

    private static function getDefaultValueColumn()
    {
        $return = [];
        if(property_exists(self::class, 'autofillOnCreate')) {
            $return["creating"] = self::$autofillOnCreate;
        }

        if(property_exists(self::class, 'autofillOnUpdate')) {
            $return["updating"] = self::$autofillOnUpdate;
        }
        return $return;

    }

    private static function getValueOfDefaultColumn()
    {
        return [
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
            //'office_id' => auth()->user()->office_id,
        ];
    }
}