<?php

namespace JokubasR\Bundle\LithuanianNamesDeclensionBundle\Tests\Service;

use JokubasR\Bundle\LithuanianNamesDeclensionBundle\Service\Declension;

/**
 * Class DeclensionTest.
 */
class DeclensionTest extends \PHPUnit_Framework_TestCase
{
    public function testGenitive()
    {
        $this->assertEquals($this->getInflected('Jokūbas Ramanauskas', Declension::CASE_GENITIVE), 'Jokūbo Ramanausko');
    }

    public function testDative()
    {
        $this->assertEquals($this->getInflected('Jokūbas Ramanauskas', Declension::CASE_DATIVE), 'Jokūbui Ramanauskui');
    }

    public function testAccusative()
    {
        $this->assertEquals($this->getInflected('Jokūbas Ramanauskas', Declension::CASE_ACCUSATIVE), 'Jokūbą Ramanauską');
    }

    public function testAblative()
    {
        $this->assertEquals($this->getInflected('Jokūbas Ramanauskas', Declension::CASE_ABLATIVE), 'Jokūbu Ramanausku');
    }

    public function testLocative()
    {
        $this->assertEquals($this->getInflected('Jokūbas Ramanauskas', Declension::CASE_LOCATIVE), 'Jokūbe Ramanauske');
    }

    public function testVocative()
    {
        $this->assertEquals($this->getInflected('Jokūbas Ramanauskas', Declension::CASE_VOCATIVE), 'Jokūbai Ramanauskai');
    }

    public function testNonLithuanianSurname()
    {
        $this->assertEquals($this->getInflected('Martynas Kačiukevič', Declension::CASE_VOCATIVE), 'Martynai Kačiukevič');
    }

    public function testNonLithuanianName()
    {
        $this->assertEquals($this->getInflected('Dmitrij Beržas', Declension::CASE_VOCATIVE), 'Dmitrij Beržai');
    }

    public function testNonNormalizedName()
    {
        $this->assertEquals($this->getInflected(' Jokūbas   1993   Ramanauskas  .,/<>;:[]{}-_=+/*-""""""', Declension::CASE_VOCATIVE), 'Jokūbai Ramanauskai');
    }

    public function testCapitalization()
    {
        $this->assertEquals($this->getInflected('jokŪBAS RAManaUskaS', Declension::CASE_VOCATIVE), 'Jokūbai Ramanauskai');
    }

    public function testDigitInsideName()
    {
        $this->assertEquals($this->getInflected('Jokū2bas Ramanauskas', Declension::CASE_VOCATIVE), 'Jokū Bai Ramanauskai');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidCase()
    {
        $this->getInflected('Name', 'fake_case');
    }

    /**
     * @param string $name
     * @param string $case
     *
     * @return string
     */
    public function getInflected($name, $case)
    {
        $declension = $this->getDeclension();

        return $declension->getInflected($name, $case);
    }

    /**
     * @return Declension
     */
    private function getDeclension()
    {
        return new Declension();
    }
}
