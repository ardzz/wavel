<?php


namespace Ardzz\Wavel\Webhooks\Collections;


/**
 * Class AbstractCollections
 * @package Ardzz\Wavel\Webhooks\Collections
 */
abstract class AbstractCollections
{
    protected array $data;

    /**
     * AbstractCollections constructor.
     * @param array $data
     */
    function __construct(array $data){
        $this->data = $data;

    }

    /**
     * @param string|null $index
     * @return string|array|null
     */
    protected function getData(string $index = null)
    {
        if (is_string($index)){
            return $this->isIndexExists($index) ? $this->data[$index] : null;
        }
        return $this->data;
    }

    /**
     * @param $index
     * @return bool
     */
    private function isIndexExists($index): bool
    {
        return array_key_exists($index, $this->getData());
    }

}
