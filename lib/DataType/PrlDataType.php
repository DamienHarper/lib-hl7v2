<?php

namespace Hl7v2\DataType;

/**
 * Parent Result Link (PRL).
 */
class PrlDataType extends ComponentDataType
{
    const MAX_LEN = 755;

    /**
     * @var \Hl7v2\DataType\CeDataType
     */
    private $parentObservationIdentifier;
    /**
     * @var \Hl7v2\DataType\StDataType
     */
    private $parentObservationSubIdentifier;
    /**
     * @var \Hl7v2\DataType\TxDataType
     */
    private $parentObservationValueDescriptor;

    /**
     * @param string $parentObservationIdentifierIdentifier
     * @param string $parentObservationIdentifierText
     * @param string $parentObservationIdentifierNameOfCodingSystem
     * @param string $parentObservationIdentifierAltIdentifier
     * @param string $parentObservationIdentifierAltText
     * @param string $parentObservationIdentifierNameOfAltCodingSystem
     */
    public function setParentObservationIdentifier(
        $parentObservationIdentifierIdentifier = null,
        $parentObservationIdentifierText = null,
        $parentObservationIdentifierNameOfCodingSystem = null,
        $parentObservationIdentifierAltIdentifier = null,
        $parentObservationIdentifierAltText = null,
        $parentObservationIdentifierNameOfAltCodingSystem = null
    ) {
        $this->parentObservationIdentifier = $this
            ->dataTypeFactory
            ->create('CE', $this->encodingParameters, true)
        ;
        $this->parentObservationIdentifier->setIdentifier($parentObservationIdentifierIdentifier);
        $this->parentObservationIdentifier->setText($parentObservationIdentifierText);
        $this->parentObservationIdentifier->setNameOfCodingSystem(
            $parentObservationIdentifierNameOfCodingSystem
        );
        $this->parentObservationIdentifier->setAltIdentifier(
            $parentObservationIdentifierAltIdentifier
        );
        $this->parentObservationIdentifier->setAltText($parentObservationIdentifierAltText);
        $this->parentObservationIdentifier->setNameOfAltCodingSystem(
            $parentObservationIdentifierNameOfAltCodingSystem
        );
    }

    /**
     * @param string $parentObservationSubIdentifier
     */
    public function setParentObservationSubIdentifier($parentObservationSubIdentifier = null)
    {
        $this->parentObservationSubIdentifier = $this
            ->dataTypeFactory
            ->create('ST', $this->encodingParameters)
        ;
        $this->parentObservationSubIdentifier->setValue($parentObservationSubIdentifier);
    }

    /**
     * @param string $parentObservationValueDescriptor
     */
    public function setParentObservationValueDescriptor($parentObservationValueDescriptor = null)
    {
        $this->parentObservationValueDescriptor = $this
            ->dataTypeFactory
            ->create('TX', $this->encodingParameters)
        ;
        $this->parentObservationValueDescriptor->setValue($parentObservationValueDescriptor);
    }

    /**
     * @return \Hl7v2\DataType\CeDataType
     */
    public function getParentObservationIdentifier()
    {
        return $this->parentObservationIdentifier;
    }

    /**
     * @return \Hl7v2\DataType\StDataType
     */
    public function getParentObservationSubIdentifier()
    {
        return $this->parentObservationSubIdentifier;
    }

    /**
     * @return \Hl7v2\DataType\TxDataType
     */
    public function getParentObservationValueDescriptor()
    {
        return $this->parentObservationValueDescriptor;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $s = '';

        $sep = $this->isSubcomponent
            ? $this->encodingParameters->getSubcomponentSep()
            : $this->encodingParameters->getComponentSep()
        ;

        if ($this->getParentObservationIdentifier()) {
            $s .= (string) $this->getParentObservationIdentifier();
        }

        $emptyComponentsSinceLastComponent = 0;

        if (!$this->getParentObservationSubIdentifier() || !$this->getParentObservationSubIdentifier()->hasValue()) {
            ++$emptyComponentsSinceLastComponent;
        } else {
            $s .= str_repeat($sep, 1 + $emptyComponentsSinceLastComponent)
                . (string) $this->getParentObservationSubIdentifier()->getValue();
            ;
            $emptyComponentsSinceLastComponent = 0;
        }

        if (!$this->getParentObservationValueDescriptor() || !$this->getParentObservationValueDescriptor()->hasValue()) {
            ++$emptyComponentsSinceLastComponent;
        } else {
            $s .= str_repeat($sep, 1 + $emptyComponentsSinceLastComponent)
                . (string) $this->getParentObservationValueDescriptor()->getValue();
            ;
            $emptyComponentsSinceLastComponent = 0;
        }

        return $s;
    }
}
