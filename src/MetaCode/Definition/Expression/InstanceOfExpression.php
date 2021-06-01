<?php

namespace Reliese\MetaCode\Definition\Expression;

use Reliese\MetaCode\Definition\ObjectTypeDefinition;
use Reliese\MetaCode\Definition\StatementDefinitionInterface;
use Reliese\MetaCode\Format\IndentationProvider;
use function sprintf;
/**
 * Class InstanceOfExpression
 */
class InstanceOfExpression implements StatementDefinitionInterface
{
    private bool $invertResult;

    private ObjectTypeDefinition $objectTypeDefinition;

    private string $valueExpresion;

    /**
     * InstanceOfExpression constructor.
     *
     * @param string               $valueExpresion
     * @param ObjectTypeDefinition $objectTypeDefinition
     * @param bool                 $invertResult
     */
    public function __construct(
        string $valueExpresion,
        ObjectTypeDefinition $objectTypeDefinition,
        bool $invertResult = false
    ) {
        $this->valueExpresion = $valueExpresion;
        $this->objectTypeDefinition = $objectTypeDefinition;
        $this->invertResult = $invertResult;
    }

    public function toPhpCode(IndentationProvider $indentationProvider): string
    {
        $result = $indentationProvider->getIndentation()
            . sprintf ("%s instanceof %s", $this->valueExpresion, $this->objectTypeDefinition);

        if ($this->invertResult) {
            $result = "!($result)";
        }

        return $result;
    }
}