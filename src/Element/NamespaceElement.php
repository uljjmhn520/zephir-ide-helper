<?php
namespace PruneMazui\ZephirIdeHelper\Element;

class NamespaceElement extends AbstractNamedElement
{
    const TYPE = 'namespace';

    /**
     * @var ClassElement[]
     */
    private $classes = [];

    /**
     * @var UseElement[]
     */
    private $uses = [];

    /**
     * @param array $param
     * @throws \LogicException
     * @return self
     */
    public static function factory(array $params): self
    {
        $type = $params['type'] ?? '';
        if ($type !== self::TYPE) {
            throw new \LogicException('Not match type ' . self::TYPE . ' AND ' . $type . '.');
        }

        $name = $params['name'] ?? '';
        if (! strlen($name)) {
            return self::factoryToplevelNamespace();
        }

        $ret = new self();
        $ret->name = $name;
        return $ret;
    }

    /**
     * @return self
     */
    public static function factoryToplevelNamespace(): self
    {
        $ret = new self();
        $ret->name = '';
        return $ret;
    }

    /**
     * @return bool
     */
    public function hasClass(): bool
    {
        return !! $this->countClass();
    }

    /**
     * @return int
     */
    public function countClass(): int
    {
        return count($this->getClasses());
    }

    /**
     * @return \PruneMazui\ZephirIdeHelper\Element\ClassElement[]
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param ClassElement $class
     * @return \PruneMazui\ZephirIdeHelper\Element\NamespaceElement
     */
    public function addClass(ClassElement $class)
    {
        $this->classes[] = $class;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasUse(): bool
    {
        return !! $this->countUse();
    }

    /**
     * @return int
     */
    public function countUse(): int
    {
        return count($this->getUses());
    }

    /**
     * @return \PruneMazui\ZephirIdeHelper\Element\UseElement[]
     */
    public function getUses()
    {
        return $this->uses;
    }

    /**
     * @param UseElement $use
     * @return self
     */
    public function addUse(UseElement $use): self
    {
        $this->uses[] = $use;
        return $this;
    }
}
