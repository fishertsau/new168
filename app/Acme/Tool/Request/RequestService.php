<?php


namespace Acme\Tool\Request;


class RequestService
{

    const FIRST_ITEM = 0;

    /**
     * @param $arrayInput
     * @param $fields
     * @return array
     */
    public static function transposeArrayInput($arrayInput, $fields)
    {
        $fields = collect($fields);
        $arrayInput = collect($arrayInput);
        $itemCount = collect($arrayInput[$fields[self::FIRST_ITEM]])->count();

        return (new self)->doTranspose($arrayInput, $fields, $itemCount);
    }

    /**
     * @param $arrayInput
     * @param $fields
     * @param $itemCount
     * @return array
     */
    private function doTranspose($arrayInput, $fields, $itemCount)
    {
        $result = [];
        for ($i = 0; $i < $itemCount; $i++) {
            $fields->each(function ($field) use ($arrayInput, $i, &$result) {
                $result[$i][$field] = $arrayInput[$field][$i];
            });
        }
        return $result;
    }
}