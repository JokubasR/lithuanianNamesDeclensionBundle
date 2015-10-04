<?php

namespace JokubasR\Bundle\LithuanianNamesDeclensionBundle\Twig\Extension;

use JokubasR\Bundle\LithuanianNamesDeclensionBundle\Service\Declension;

/**
 * Class DeclensionExtension
 * @package JokubasR\Bundle\LithuanianNamesDeclensionBundle\Twig\Extension
 */
class DeclensionExtension extends \Twig_Extension
{
    /**
     * @var Declension
     */
    protected $declension;

    /**
     * DeclensionExtension constructor.
     * @param Declension $declension
     */
    public function __construct(
        Declension $declension
    )
    {
        $this->declension = $declension;
    }
    
    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('inflect', [$this, 'getInflected']),
            new \Twig_SimpleFilter('case', [$this, 'getInflected']),

            new \Twig_SimpleFilter('genitive', [$this, 'getGenitive']),
            new \Twig_SimpleFilter('dative', [$this, 'getDative']),
            new \Twig_SimpleFilter('accusative', [$this, 'getGenitive']),
            new \Twig_SimpleFilter('ablative', [$this, 'getAblative']),
            new \Twig_SimpleFilter('locative', [$this, 'getLocative']),
            new \Twig_SimpleFilter('vocative', [$this, 'getVocative']),
        ];
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('getInflected', [$this, 'getInflected']),

            new \Twig_SimpleFunction('getGenitive', [$this, 'getGenitive']),
            new \Twig_SimpleFunction('getDative', [$this, 'getDative']),
            new \Twig_SimpleFunction('getAccusative', [$this, 'getGenitive']),
            new \Twig_SimpleFunction('getAblative', [$this, 'getAblative']),
            new \Twig_SimpleFunction('getLocative', [$this, 'getLocative']),
            new \Twig_SimpleFunction('getVocative', [$this, 'getVocative']),
        ];
    }

    /**
     * @param string $name
     * @param string $case
     * @return string
     */
    public function getInflected($name, $case = Declension::CASE_VOCATIVE)
    {
        try {
            return $this->declension->getInflected($name, $case);
        } catch (\Exception $exception) {
            return $name;
        }
    }

    /**
     * @param string $name
     * @return string
     */
    public function getGenitive($name)
    {
        return $this->getInflected($name, Declension::CASE_GENITIVE);
    }

    /**
     * @param string $name
     * @return string
     */
    public function getDative($name)
    {
        return $this->getInflected($name, Declension::CASE_DATIVE);
    }

    /**
     * @param string $name
     * @return string
     */
    public function getAccusative($name)
    {
        return $this->getInflected($name, Declension::CASE_ACCUSATIVE);
    }
    
    /**
     * @param string $name
     * @return string
     */
    public function getAblative($name)
    {
        return $this->getInflected($name, Declension::CASE_ABLATIVE);
    }
    
    /**
     * @param string $name
     * @return string
     */
    public function getLocative($name)
    {
        return $this->getInflected($name, Declension::CASE_LOCATIVE);
    }
   
    /**
     * @param string $name
     * @return string
     */
    public function getVocative($name)
    {
        return $this->getInflected($name, Declension::CASE_VOCATIVE);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'declension';
    }
}
