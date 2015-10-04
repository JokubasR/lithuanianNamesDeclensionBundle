<?php

namespace JokubasR\Bundle\LithuanianNamesDeclensionBundle\Service;

/**
 * Class Declension.
 *
 * @see https://gist.github.com/JokubasR/2b985753530f21094db7#file-lietuviskivardai-php
 * @copyright Copyleft (ↄ) 2011, Dainius Kaupaitis
 */
class Declension
{
    const CASE_GENITIVE = 'genitive';
    const CASE_DATIVE = 'dative';
    const CASE_ACCUSATIVE = 'accusative';
    const CASE_ABLATIVE = 'ablative';
    const CASE_LOCATIVE = 'locative';
    const CASE_VOCATIVE = 'vocative';

    /**
     * @var array
     */
    protected $genitives = [
        'a' => 'os',
        'as' => 'o',
        'ė' => 'ės',
        'tis' => 'čio',
        'dis' => 'džio',
        'is' => 'io',
        'us' => 'aus',
        'tys' => 'čio',
        'dys' => 'džio',
        'ys' => 'io',
    ];

    /**
     * @var array
     */
    protected $datives = [
        'a' => 'ai',
        'as' => 'ui',
        'ė' => 'ei',
        'tis' => 'čiui',
        'dis' => 'džiui',
        'is' => 'iui',
        'us' => 'ui',
        'tys' => 'čiui',
        'dys' => 'džiui',
        'ys' => 'iui',
    ];

    /**
     * @var array
     */
    protected $accusatives = [
        'a' => 'ą',
        'as' => 'ą',
        'ė' => 'ę',
        'is' => 'į',
        'us' => 'ų',
        'ys' => 'į',
    ];

    /**
     * @var array
     */
    protected $ablatives = [
        'a' => 'a',
        'as' => 'u',
        'ė' => 'e',
        'tis' => 'čiu',
        'dis' => 'džiu',
        'is' => 'iu',
        'us' => 'u',
        'tys' => 'čiu',
        'dys' => 'džiu',
        'ys' => 'iu',
    ];

    /**
     * @var array
     */
    protected $locatives = [
        'a' => 'oje',
        'as' => 'e',
        'ė' => 'ėje',
        'is' => 'yje',
        'us' => 'uje',
        'ys' => 'yje',
    ];

    /**
     * @var array
     */
    protected $vocatives = [
        'a' => 'a',
        'as' => 'ai',
        'ė' => 'e',
        'is' => 'i',
        'us' => 'au',
        'ys' => 'y',
    ];

    /**
     * Declension constructor.
     * @param string $encoding
     */
    public function __construct($encoding = 'UTF-8')
    {
        mb_internal_encoding($encoding);
    }

    /**
     * @return array
     */
    public static function getCases()
    {
        return [
            static::CASE_GENITIVE => static::CASE_GENITIVE,
            static::CASE_DATIVE => static::CASE_DATIVE,
            static::CASE_ACCUSATIVE => static::CASE_ACCUSATIVE,
            static::CASE_ABLATIVE => static::CASE_ABLATIVE,
            static::CASE_LOCATIVE => static::CASE_LOCATIVE,
            static::CASE_VOCATIVE => static::CASE_VOCATIVE,
        ];
    }

    /**
     * @param string $string
     * @param string $case
     * @return string
     */
    public function getInflected($string, $case = self::CASE_VOCATIVE)
    {
        $this->validateCase($case);

        $string = $this->getNormalizedString($string);
        $names = $this->getExplodedWords($string);

        $inflected = [];
        foreach ($names as $name) {
            $inflected[] = $this->getInflectedName($name, $case);
        }

        return implode(' ', $inflected);
    }

    /**
     * @param string $name
     * @param string $case
     * @return string
     */
    protected function getInflectedName($name, $case)
    {
        $caseEndings = $this->getCaseEndings($case);

        $correctEndings = $this->detectCorrectCaseEnding($name, $caseEndings);

        if (!empty($correctEndings)) {
            list ($from, $to) = $correctEndings;
            $inflected =  mb_substr($name, 0, -mb_strlen($from)) . $to;
        } else {
            $inflected = $name;
        }

        return $inflected;
    }

    /**
     * @param $string
     * @return array
     */
    protected function getExplodedWords($string)
    {
        $names = explode(' ', $string);

        return $names;
    }

    /**
     * Normalizes string so it would only contain letters
     * and no other characters.
     *
     * @param $string
     * @return string
     */
    protected function getNormalizedString($string)
    {
        $string = mb_eregi_replace('[^a-zą-ž]', ' ', $string);
        $string = mb_eregi_replace('\s+', ' ', $string);
        $string = trim($string);
        $string = mb_convert_case($string, MB_CASE_TITLE);

        return $string;
    }

    /**
     * @param string $case
     *
     * @throws \InvalidArgumentException
     *
     * @return bool
     */
    private function validateCase($case)
    {
        if (!in_array($case, $this::getCases())) {
            throw new \InvalidArgumentException(sprintf(
                'Case %s doesn\'t exists. Only %s cases are available.',
                $case,
                implode(', ', $this::getCases())
            ));
        }

        return true;
    }

    /**
     * @param string $case
     *
     * @return array
     */
    private function getCaseEndings($case)
    {
        $property = strtolower($case) . 's';

        return $this->$property;
    }

    /**
     * @param string $word
     * @param array $endings
     * @return array
     */
    private function detectCorrectCaseEnding($word, array $endings)
    {
        foreach ($endings as $from => $to) {
            if (mb_substr($word, -mb_strlen($from)) == $from) {
                return [$from, $to];
            }
        }

        return [];
    }
}
