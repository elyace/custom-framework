<?php

namespace CFM\Presenter;

abstract class AbstractPresenter  implements \JsonSerializable, \ArrayAccess
{

    public function jsonSerialize(): array
    {
        return $this->present();
    }

    /**
     * @return array
     */
    abstract public function present(): array;

    public function offsetExists(mixed $offset): bool
    {
        $fields = $this->getFields();

        return property_exists($this, $offset) && in_array($offset, $fields);
    }

    public function offsetGet(mixed $offset): mixed
    {

        $fields = $this->getFields();
        if( !in_array($offset, $fields) )
        {
            throw new \RuntimeException("Array key $offset does not exists");
        }

        $property = snake_to_camel($offset);

        return $this->$property;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \RuntimeException('Presenter are immutable');
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new \RuntimeException('Presenter are immutable');
    }

    /**
     * @return array
     */
    private function getFields(): array
    {
        $keys = array_keys($this->present());

        return array_merge(
            array_map('camel_to_snake', $keys),
            array_map('snake_to_camel', $keys),
        );
    }
}