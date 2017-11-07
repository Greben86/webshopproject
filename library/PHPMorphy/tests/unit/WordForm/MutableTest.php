<?php
/**
 * Test class for phpMorphy_WordForm_WordForm.
 * Generated by PHPUnit on 2010-12-20 at 01:49:46.
 */
class test_WordForm_Mutable extends PHPUnit_Framework_TestCase
{
    /**
     * @var phpMorphy_WordForm_WordForm
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $form = $this->object = $this->createWordForm();
        $form->setBase('base');
        $form->setCommonGrammems(array('common', 'grammems'));
        $form->setCommonPrefix('common_prefix');
        $form->setFormGrammems(array('form', 'grammems'));
        $form->setPartOfSpeech('pos');
        $form->setFormPrefix('prefix');
        $form->setSuffix('suffix');
    }

    protected function createWordForm() {
        return new phpMorphy_WordForm_WordForm(
            $this->getMock('phpMorphy_Paradigm_ParadigmInterface')
        );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->object = null;
    }

    /**
     * @todo Implement testAssignFromWordForm().
     */
    public function testAssignFromWordForm()
    {
        $form = $this->createWordForm();

        $array_methods = array(
            'setCommonGrammems',
            'setFormGrammems',
        );

        $methods = array(
            'setBase',
            'setCommonPrefix',
            'setPartOfSpeech',
            'setFormPrefix',
            'setSuffix',
        );

        $methods = array_merge($array_methods, $methods);

        $i = 0;
        foreach($methods as $method) {
            $value = sprintf('string_%04d', mt_rand(0, PHP_INT_MAX));
            
            if(in_array($method, $array_methods)) {
                $form->$method(range(0, 100));
            } else {
                $form->$method($value);
            }
        }

        $new_form = new phpMorphy_WordForm_WordForm($form->getParadigm());
        $new_form->assignFromWordForm($form);

        foreach($methods as $set_method) {
            $method = preg_replace('/^set/', 'get', $set_method);

            $this->assertEquals(
                $form->$method(),
                $new_form->$method(),
                "Method $method() fails"
            );
        }
    }

    function testGrammems() {
        $this->assertEquals(
            array_diff(
                $this->object->getGrammems(),
                array_merge($this->object->getCommonGrammems(), $this->object->getFormGrammems())
            ),
            array()
        );
    }

    function testPrefix() {
        $this->assertEquals(
            $this->object->getCommonPrefix() . $this->object->getFormPrefix(),
            $this->object->getPrefix()
        );
    }
}
?>