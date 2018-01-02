<?php

include_once dirname(__FILE__) . '/../../validator/Validation_Converter.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-12-29 at 13:28:57.
 */
class Validation_ConditionTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Validation_Condition
     */
    protected $object;
    
    protected $simpleInput = array('a'=>2, 'b'=>[1,2,3,4], 'c'=>null, 'd'=>'abc', '2'=>1.2, 2=>'1.2', 0=>true, 1=>0, 'i'=>1, 'j'=>[], 'k'=>'', 'l'=>'2');
    protected $simpleInput2 = array('a'=>1, 'a2'=>1, 'b'=>'1', 'b2'=>'1', 'c'=>null, 'c2'=>null, 'd'=>[], 'd2'=>[], 'e'=>[1,2,3,4], 'e2'=>[1,2,3,4], 1=>[1,2,3], 12=>[1,2,3]);
    protected $simpleInput2Keys = array('a','b','c','d','e',1);
    protected $simpleFileInput = array('a'=>['error'=>0, 'tmp_name'=>'a_tmp.txt', 'name'=>'a.txt', 'size'=>5]);


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Validation_Condition;
        $simpleInput = array('a'=>2, 'b'=>[1,2,3,4], 'c'=>null, 'd'=>'abc', '2'=>1.2, 2=>'1.2', 0=>true, 1=>0, 'i'=>1, 'j'=>[], 'k'=>'', 'l'=>'2');
        $simpleInput2 = array('a'=>1, 'a2'=>1, 'b'=>'1', 'b2'=>'1', 'c'=>null, 'c2'=>null, 'd'=>[], 'd2'=>[], 'e'=>[1,2,3,4], 'e2'=>[1,2,3,4], 1=>[1,2,3], 12=>[1,2,3]);
        $simpleInput2Keys = array('a','b','c','d','e',1);
        $simpleFileInput = array('a'=>['error'=>0, 'tmp_name'=>'a_tmp.txt', 'name'=>'a.txt', 'size'=>5]);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Validation_Condition::getIndicator
     */
    public function testGetIndicator() {
        self::assertEquals('satisfy', $this->object->getIndicator());
    }

    /**
     * @covers Validation_Condition::validate_satisfy_exists
     * @todo   Implement testValidate_satisfy_exists().
     */
    public function testValidate_satisfy_exists() {
        self::assertSame(null, $this->object->validate_satisfy_exists('a', $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_exists(1, $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_exists([], $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_exists(null, $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_exists([1,2,3,4], $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_exists('z', $this->simpleInput));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_not_exists
     */
    public function testValidate_satisfy_not_exists() {
        self::assertSame(false, $this->object->validate_satisfy_not_exists('a', $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_not_exists(1, $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_not_exists([], $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_not_exists(null, $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_not_exists([1,2,3,4], $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_not_exists('z', $this->simpleInput));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_required
     */
    public function testValidate_satisfy_required() {
        self::assertSame(null, $this->object->validate_satisfy_required('a', $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_required(1, $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_required([], $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_required(null, $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_required([1,2,3,4], $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_required('z', $this->simpleInput));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_isset
     */
    public function testValidate_satisfy_isset() {
        self::assertSame(null, $this->object->validate_satisfy_isset('a', $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_isset(1, $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_isset([], $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_isset(null, $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_isset([1,2,3,4], $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_isset('z', $this->simpleInput));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_not_isset
     */
    public function testValidate_satisfy_not_isset() {
        self::assertSame(false, $this->object->validate_satisfy_not_isset('a', $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_not_isset(1, $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_not_isset([], $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_not_isset(null, $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_not_isset([1,2,3,4], $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_not_isset('z', $this->simpleInput));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_not_empty
     */
    public function testValidate_satisfy_not_empty() {
        self::assertSame(null, $this->object->validate_satisfy_not_empty('a', $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_not_empty(1, $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_not_empty([], $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_not_empty(null, $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_not_empty([1,2,3,4], $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_not_empty('z', $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_not_empty('c', $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_not_empty('j', $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_not_empty('k', $this->simpleInput));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_empty
     */
    public function testValidate_satisfy_empty() {
        self::assertSame(false, $this->object->validate_satisfy_empty('a', $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_empty(1, $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_empty([], $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_empty(null, $this->simpleInput));
        self::assertSame(false, $this->object->validate_satisfy_empty([1,2,3,4], $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_empty('z', $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_empty('c', $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_empty('j', $this->simpleInput));
        self::assertSame(null, $this->object->validate_satisfy_empty('k', $this->simpleInput));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_equals_field
     */
    public function testValidate_satisfy_equals_field() {
        // ungleiche Felder
        for ($i=0;$i<count($this->simpleInput2Keys);$i++){
            for ($b=$i+1;$b<count($this->simpleInput2Keys);$b++){
                self::assertSame(false, $this->object->validate_satisfy_equals_field($this->simpleInput2Keys[$i], $this->simpleInput2, null, $this->simpleInput2Keys[$b]));
            }            
        }

        // gleiche Felder
        for ($i=0;$i<count($this->simpleInput2Keys);$i++){
            self::assertSame(null, $this->object->validate_satisfy_equals_field($this->simpleInput2Keys[$i], $this->simpleInput2, null, $this->simpleInput2Keys[$i].'2'));        
        }
        
        // Besonderheiten
        self::assertSame(false, $this->object->validate_satisfy_equals_field('a', $this->simpleInput2, null, 'zzz'));
        self::assertSame(false, $this->object->validate_satisfy_equals_field('zzz', $this->simpleInput2, null, 'a'));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_not_equals_field
     */
    public function testValidate_satisfy_not_equals_field() {
        // ungleiche Felder
        for ($i=0;$i<count($this->simpleInput2Keys);$i++){
            for ($b=$i+1;$b<count($this->simpleInput2Keys);$b++){
                self::assertSame(null, $this->object->validate_satisfy_not_equals_field($this->simpleInput2Keys[$i], $this->simpleInput2, null, $this->simpleInput2Keys[$b]));
            }            
        }

        // gleiche Felder
        for ($i=0;$i<count($this->simpleInput2Keys);$i++){
            self::assertSame(false, $this->object->validate_satisfy_not_equals_field($this->simpleInput2Keys[$i], $this->simpleInput2, null, $this->simpleInput2Keys[$i].'2'), 'Key: '.$this->simpleInput2Keys[$i]);        
        }
        
        // Besonderheiten
        self::assertSame(null, $this->object->validate_satisfy_not_equals_field('a', $this->simpleInput2, null, 'zzz'));
        self::assertSame(null, $this->object->validate_satisfy_not_equals_field('zzz', $this->simpleInput2, null, 'a'));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_regex
     */
    public function testValidate_satisfy_regex() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Validation_Condition::validate_satisfy_equalTo
     */
    public function testValidate_satisfy_equalTo() {
        // ungleiche Felder
        for ($i=0;$i<count($this->simpleInput2Keys);$i++){
            for ($b=$i+1;$b<count($this->simpleInput2Keys);$b++){
                self::assertSame(false, $this->object->validate_satisfy_equalTo($this->simpleInput2Keys[$i], $this->simpleInput2, null, $this->simpleInput2[$this->simpleInput2Keys[$b]]), 'Feld:'.$this->simpleInput2Keys[$i]);
            }            
        }

        // gleiche Felder
        for ($i=0;$i<count($this->simpleInput2Keys);$i++){
            self::assertSame(null, $this->object->validate_satisfy_equalTo($this->simpleInput2Keys[$i], $this->simpleInput2, null, $this->simpleInput2[$this->simpleInput2Keys[$i]]), 'Feld:'.$this->simpleInput2Keys[$i]);        
        }
    }

    /**
     * @covers Validation_Condition::validate_satisfy_min_numeric
     */
    public function testValidate_satisfy_min_numeric() {
        $i=0;
        foreach ($this->simpleInput as $key => $value){
            self::assertSame(false, $this->object->validate_satisfy_min_numeric($key, $this->simpleInput,null, 10), $key);
            
            if ($value===null)$value='nnn';
            $this->simpleInput['q'] = 55;
            $this->object->validate_satisfy_min_numeric('q', $this->simpleInput,null, $value);
            $i++;
        }
        
        $this->simpleInput['a2'] = 1;
        $this->simpleInput['a3'] = 3;
        $this->simpleInput['l2'] = '1';
        $this->simpleInput['l3'] = '3';
        self::assertSame(null, $this->object->validate_satisfy_min_numeric('a', $this->simpleInput,null, 2));
        self::assertSame(false, $this->object->validate_satisfy_min_numeric('a2', $this->simpleInput,null, 2));
        self::assertSame(null, $this->object->validate_satisfy_min_numeric('a3', $this->simpleInput,null, 2));
        
        self::assertSame(null, $this->object->validate_satisfy_min_numeric('l', $this->simpleInput,null, '2'));
        self::assertSame(false, $this->object->validate_satisfy_min_numeric('l2', $this->simpleInput,null, '2'));
        self::assertSame(null, $this->object->validate_satisfy_min_numeric('l3', $this->simpleInput,null, '2'));
        
        self::assertSame(null, $this->object->validate_satisfy_min_numeric('l', $this->simpleInput,null, 2));
        self::assertSame(false, $this->object->validate_satisfy_min_numeric('l2', $this->simpleInput,null, 2));
        self::assertSame(null, $this->object->validate_satisfy_min_numeric('l3', $this->simpleInput,null, 2));
        
        self::assertSame(null, $this->object->validate_satisfy_min_numeric('a', $this->simpleInput,null, '2'));
        self::assertSame(false, $this->object->validate_satisfy_min_numeric('a2', $this->simpleInput,null, '2'));
        self::assertSame(null, $this->object->validate_satisfy_min_numeric('a3', $this->simpleInput,null, '2'));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_max_numeric
     */
    public function testValidate_satisfy_max_numeric() {
        $i=0;
        foreach ($this->simpleInput as $key => $value){
            $this->object->validate_satisfy_max_numeric($key, $this->simpleInput,null, 1);
            
            if ($value===null)$value='nnn';
            $this->object->validate_satisfy_max_numeric('a', $this->simpleInput,null, $value);
            $i++;
        }
        
        $this->simpleInput['a2'] = 1;
        $this->simpleInput['a3'] = 3;
        $this->simpleInput['l2'] = '1';
        $this->simpleInput['l3'] = '3';
        self::assertSame(null, $this->object->validate_satisfy_max_numeric('a', $this->simpleInput,null, 2));
        self::assertSame(null, $this->object->validate_satisfy_max_numeric('a2', $this->simpleInput,null, 2));
        self::assertSame(false, $this->object->validate_satisfy_max_numeric('a3', $this->simpleInput,null, 2));
        
        self::assertSame(null, $this->object->validate_satisfy_max_numeric('l', $this->simpleInput,null, '2'));
        self::assertSame(null, $this->object->validate_satisfy_max_numeric('l2', $this->simpleInput,null, '2'));
        self::assertSame(false, $this->object->validate_satisfy_max_numeric('l3', $this->simpleInput,null, '2'));
        
        self::assertSame(null, $this->object->validate_satisfy_max_numeric('a', $this->simpleInput,null, '2'));
        self::assertSame(null, $this->object->validate_satisfy_max_numeric('a2', $this->simpleInput,null, '2'));
        self::assertSame(false, $this->object->validate_satisfy_max_numeric('a3', $this->simpleInput,null, '2'));
        
        self::assertSame(null, $this->object->validate_satisfy_max_numeric('l', $this->simpleInput,null, 2));
        self::assertSame(null, $this->object->validate_satisfy_max_numeric('l2', $this->simpleInput,null, 2));
        self::assertSame(false, $this->object->validate_satisfy_max_numeric('l3', $this->simpleInput,null, 2));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_exact_numeric
     */
    public function testValidate_satisfy_exact_numeric() {
        $i=0;
        foreach ($this->simpleInput as $key => $value){
            self::assertSame(false, $this->object->validate_satisfy_exact_numeric($key, $this->simpleInput,null, 10), $key);
            
            if ($value===null)$value='nnn';
            $this->simpleInput['q'] = '55';
            self::assertSame(false, $this->object->validate_satisfy_exact_numeric('q', $this->simpleInput,null, $value), $value);
            $i++;
        }
        
        $this->simpleInput['a2'] = 1;
        $this->simpleInput['a3'] = 3;
        $this->simpleInput['l2'] = '1';
        $this->simpleInput['l3'] = '3';
        self::assertSame(null, $this->object->validate_satisfy_exact_numeric('a', $this->simpleInput,null, 2));
        self::assertSame(false, $this->object->validate_satisfy_exact_numeric('a2', $this->simpleInput,null, 2));
        self::assertSame(false, $this->object->validate_satisfy_exact_numeric('a3', $this->simpleInput,null, 2));
        
        self::assertSame(null, $this->object->validate_satisfy_exact_numeric('l', $this->simpleInput,null, '2'));
        self::assertSame(false, $this->object->validate_satisfy_exact_numeric('l2', $this->simpleInput,null, '2'));
        self::assertSame(false, $this->object->validate_satisfy_exact_numeric('l3', $this->simpleInput,null, '2'));
        
        self::assertSame(false, $this->object->validate_satisfy_exact_numeric('l', $this->simpleInput,null, 2));
        self::assertSame(false, $this->object->validate_satisfy_exact_numeric('l2', $this->simpleInput,null, 2));
        self::assertSame(false, $this->object->validate_satisfy_exact_numeric('l3', $this->simpleInput,null, 2));
        
        self::assertSame(false, $this->object->validate_satisfy_exact_numeric('a', $this->simpleInput,null, '2'));
        self::assertSame(false, $this->object->validate_satisfy_exact_numeric('a2', $this->simpleInput,null, '2'));
        self::assertSame(false, $this->object->validate_satisfy_exact_numeric('l3', $this->simpleInput,null, '2'));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_min_len
     */
    public function testValidate_satisfy_min_len() {
        $i=0;
        foreach ($this->simpleInput as $key => $value){
            self::assertSame(false, $this->object->validate_satisfy_min_len($key, $this->simpleInput,null, 10), $key);
            
            if ($value===null)$value='nnn';
            $this->object->validate_satisfy_min_len('b', $this->simpleInput,null, $value);
            $i++;
        }
        
        $this->simpleInput['d2'] = 'ab';
        $this->simpleInput['d3'] = 'abcd';
        $this->simpleInput['b2'] = [1,2,3];
        $this->simpleInput['b3'] = [1,2,3,4,5];
        self::assertSame(null, $this->object->validate_satisfy_min_len('d', $this->simpleInput,null, 3));
        self::assertSame(false, $this->object->validate_satisfy_min_len('d2', $this->simpleInput,null, 3));
        self::assertSame(null, $this->object->validate_satisfy_min_len('d3', $this->simpleInput,null, 3));
        
        self::assertSame(null, $this->object->validate_satisfy_min_len('b', $this->simpleInput,null, 4));
        self::assertSame(false, $this->object->validate_satisfy_min_len('b2', $this->simpleInput,null, 4));
        self::assertSame(null, $this->object->validate_satisfy_min_len('b3', $this->simpleInput,null, 4));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_max_len
     */
    public function testValidate_satisfy_max_len() {
        $i=0;
        foreach ($this->simpleInput as $key => $value){
            $expected=false;
            if ($key === 'j' || $key === 'l') $expected=null;
            self::assertSame($expected, $this->object->validate_satisfy_max_len($key, $this->simpleInput,null, 1), $key);
            
            if ($value===null)$value='nnn';
            $this->object->validate_satisfy_max_len('b', $this->simpleInput,null, $value);
            $i++;
        }
        
        $this->simpleInput['d2'] = 'ab';
        $this->simpleInput['d3'] = 'abcd';
        $this->simpleInput['b2'] = [1,2,3];
        $this->simpleInput['b3'] = [1,2,3,4,5];
        self::assertSame(null, $this->object->validate_satisfy_max_len('d', $this->simpleInput,null, 3));
        self::assertSame(null, $this->object->validate_satisfy_max_len('d2', $this->simpleInput,null, 3));
        self::assertSame(false, $this->object->validate_satisfy_max_len('d3', $this->simpleInput,null, 3));
        
        self::assertSame(null, $this->object->validate_satisfy_max_len('b', $this->simpleInput,null, 4));
        self::assertSame(null, $this->object->validate_satisfy_max_len('b2', $this->simpleInput,null, 4));
        self::assertSame(false, $this->object->validate_satisfy_max_len('b3', $this->simpleInput,null, 4));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_exact_len
     */
    public function testValidate_satisfy_exact_len() {
        $i=0;
        foreach ($this->simpleInput as $key => $value){
            self::assertSame(false, $this->object->validate_satisfy_exact_len($key, $this->simpleInput,null, 10), $key);
            
            if ($value===null)$value='nnn';
            $this->object->validate_satisfy_exact_len('b', $this->simpleInput,null, $value);
            $i++;
        }
        
        $this->simpleInput['d2'] = 'ab';
        $this->simpleInput['d3'] = 'abcd';
        $this->simpleInput['b2'] = [1,2,3];
        $this->simpleInput['b3'] = [1,2,3,4,5];
        self::assertSame(null, $this->object->validate_satisfy_exact_len('d', $this->simpleInput,null, 3));
        self::assertSame(false, $this->object->validate_satisfy_exact_len('d2', $this->simpleInput,null, 3));
        self::assertSame(false, $this->object->validate_satisfy_exact_len('d3', $this->simpleInput,null, 3));
        
        self::assertSame(null, $this->object->validate_satisfy_exact_len('b', $this->simpleInput,null, 4));
        self::assertSame(false, $this->object->validate_satisfy_exact_len('b2', $this->simpleInput,null, 4));
        self::assertSame(false, $this->object->validate_satisfy_exact_len('b3', $this->simpleInput,null, 4));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_in_list
     */
    public function testValidate_satisfy_in_list() {
        $i=0;
        foreach ($this->simpleInput as $key => $value){
            if ($key==='c') continue;
            self::assertSame(null, $this->object->validate_satisfy_in_list($key, $this->simpleInput, null,  $this->simpleInput), $key);
            $i++;
        }

        self::assertSame(false, $this->object->validate_satisfy_in_list('zz', $this->simpleInput, null,  $this->simpleInput));
        $this->simpleInput['zz']=5;
        self::assertSame(null, $this->object->validate_satisfy_in_list('zz', $this->simpleInput, null,  $this->simpleInput));
        //$this->object->validate_satisfy_in_list('zz', $this->simpleInput, null,  null);
        self::assertSame(false, $this->object->validate_satisfy_in_list('zz', $this->simpleInput, null,  array()));
        //$this->object->validate_satisfy_in_list('zz', $this->simpleInput, null,  5);
        //$this->object->validate_satisfy_in_list('zz', $this->simpleInput, null,  '5');
    }

    /**
     * @covers Validation_Condition::validate_satisfy_not_in_list
     */
    public function testValidate_satisfy_not_in_list() {
        $i=0;
        foreach ($this->simpleInput as $key => $value){
            if ($key==='c') continue;
            self::assertSame(false, $this->object->validate_satisfy_not_in_list($key, $this->simpleInput, null,  $this->simpleInput), $key);
            $i++;
        }

        self::assertSame(null, $this->object->validate_satisfy_not_in_list('zz', $this->simpleInput, null,  $this->simpleInput));
        $this->simpleInput['zz']=5;
        self::assertSame(false, $this->object->validate_satisfy_not_in_list('zz', $this->simpleInput, null,  $this->simpleInput));
        //$this->object->validate_satisfy_not_in_list('zz', $this->simpleInput, null,  null);
        self::assertSame(null, $this->object->validate_satisfy_not_in_list('zz', $this->simpleInput, null,  array()));
        //$this->object->validate_satisfy_not_in_list('zz', $this->simpleInput, null,  5);
        //$this->object->validate_satisfy_not_in_list('zz', $this->simpleInput, null,  '5');
    }

    /**
     * @covers Validation_Condition::validate_satisfy_value
     */
    public function testValidate_satisfy_value() {
        // ungleiche Felder
        for ($i=0;$i<count($this->simpleInput2Keys);$i++){
            for ($b=$i+1;$b<count($this->simpleInput2Keys);$b++){
                self::assertSame(false, $this->object->validate_satisfy_value($this->simpleInput2Keys[$i], $this->simpleInput2, null, $this->simpleInput2[$this->simpleInput2Keys[$b]]), 'Feld:'.$this->simpleInput2Keys[$i]);
            }            
        }

        // gleiche Felder
        for ($i=0;$i<count($this->simpleInput2Keys);$i++){
            self::assertSame(null, $this->object->validate_satisfy_value($this->simpleInput2Keys[$i], $this->simpleInput2, null, $this->simpleInput2[$this->simpleInput2Keys[$i]]), 'Feld:'.$this->simpleInput2Keys[$i]);        
        }
    }

    /**
     * @covers Validation_Condition::validate_satisfy_file_exists
     */
    public function testValidate_satisfy_file_exists() {
        if (file_exists($this->simpleFileInput['a']['tmp_name'])) unlink($this->simpleFileInput['a']['tmp_name']);
        self::assertSame(false, $this->object->validate_satisfy_file_exists('a', $this->simpleFileInput));
        file_put_contents($this->simpleFileInput['a']['tmp_name'], 'aaaaa');
        self::assertSame(null, $this->object->validate_satisfy_file_exists('a', $this->simpleFileInput));
        unset($this->simpleFileInput['a']['tmp_name']);
        self::assertSame(false, $this->object->validate_satisfy_file_exists('a', $this->simpleFileInput));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_file_isset
     */
    public function testValidate_satisfy_file_isset() {
        self::assertSame(null, $this->object->validate_satisfy_file_isset('a', $this->simpleFileInput));
        unset($this->simpleFileInput['a']['tmp_name']);
        self::assertSame(false, $this->object->validate_satisfy_file_isset('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['tmp_name']='a';
        self::assertSame(null, $this->object->validate_satisfy_file_isset('a', $this->simpleFileInput));
        unset($this->simpleFileInput['a']['name']);
        self::assertSame(false, $this->object->validate_satisfy_file_isset('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['name']='a';
        self::assertSame(null, $this->object->validate_satisfy_file_isset('a', $this->simpleFileInput));
        unset($this->simpleFileInput['a']['error']);
        self::assertSame(false, $this->object->validate_satisfy_file_isset('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['error']='a';
        self::assertSame(null, $this->object->validate_satisfy_file_isset('a', $this->simpleFileInput));
        unset($this->simpleFileInput['a']['size']);
        self::assertSame(false, $this->object->validate_satisfy_file_isset('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['size']='a';
        self::assertSame(null, $this->object->validate_satisfy_file_isset('a', $this->simpleFileInput));
        unset($this->simpleFileInput['a']);
        self::assertSame(false, $this->object->validate_satisfy_file_isset('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['name']='a';
        $this->simpleFileInput['a']['size']='a';
        $this->simpleFileInput['a']['error']='a';
        $this->simpleFileInput['a']['tmp_name']='a';
        self::assertSame(null, $this->object->validate_satisfy_file_isset('a', $this->simpleFileInput));
    }

    /**
     * @covers Validation_Condition::validate_satisfy_file_error
     */
    public function testValidate_satisfy_file_error() {
        self::assertSame(false, $this->object->validate_satisfy_file_error('a', $this->simpleFileInput));
        unset($this->simpleFileInput['a']['error']);
        self::assertSame(null, $this->object->validate_satisfy_file_error('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['error']=1;
        self::assertSame(null, $this->object->validate_satisfy_file_error('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['error']=3;
        self::assertSame(null, $this->object->validate_satisfy_file_error('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['error']=4;
        self::assertSame(false, $this->object->validate_satisfy_file_error('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['error']=5;
        self::assertSame(null, $this->object->validate_satisfy_file_error('a', $this->simpleFileInput));
        
        foreach($this->simpleInput as $key => $value){
            $this->simpleFileInput['a']['error']=$value;
            $expected=null;
            if ($value===0 || $value===4)$expected=false;
            self::assertSame($expected, $this->object->validate_satisfy_file_error('a', $this->simpleFileInput), $key);            
        }
    }

    /**
     * @covers Validation_Condition::validate_satisfy_file_no_error
     */
    public function testValidate_satisfy_file_no_error() {
        self::assertSame(null, $this->object->validate_satisfy_file_no_error('a', $this->simpleFileInput));
        unset($this->simpleFileInput['a']['error']);
        self::assertSame(false, $this->object->validate_satisfy_file_no_error('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['error']=1;
        self::assertSame(false, $this->object->validate_satisfy_file_no_error('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['error']=3;
        self::assertSame(false, $this->object->validate_satisfy_file_no_error('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['error']=4;
        self::assertSame(null, $this->object->validate_satisfy_file_no_error('a', $this->simpleFileInput));
        $this->simpleFileInput['a']['error']=5;
        self::assertSame(false, $this->object->validate_satisfy_file_no_error('a', $this->simpleFileInput));
        
        foreach($this->simpleInput as $key => $value){
            $this->simpleFileInput['a']['error']=$value;
            $expected=false;
            if ($value===0 || $value===4)$expected=null;
            self::assertSame($expected, $this->object->validate_satisfy_file_no_error('a', $this->simpleFileInput), $key);            
        }
    }

    /**
     * @covers Validation_Condition::validate_satisfy_file_extension
     */
    public function testValidate_satisfy_file_extension() {
        // es wird eine konkrete Dateierweiterung geprüft
        self::assertSame(null, $this->object->validate_satisfy_file_extension('a', $this->simpleFileInput,null,'txt'));
        self::assertSame(false, $this->object->validate_satisfy_file_extension('a', $this->simpleFileInput,null,'txt2'));
        self::assertSame(false, $this->object->validate_satisfy_file_extension('a', $this->simpleFileInput,null,'png'));
        
        // die Prüfung soll anhand einer Validierung erfolgen
        // todo...
        
        foreach($this->simpleInput as $key => $value){
            if (is_array($value) || $value === null) {
                continue;
            }
            
            self::assertSame(false, $this->object->validate_satisfy_file_extension('a', $this->simpleFileInput, null, $value), $key);            
        }
        
        foreach($this->simpleInput as $key => $value){
            if (is_array($value)) {
                continue;
            }
            
            $this->simpleFileInput['a']['name']='a.'.$value;
            self::assertSame(false, $this->object->validate_satisfy_file_extension('a', $this->simpleFileInput, null, 'txt'), $key);            
        }
    }

    /**
     * @covers Validation_Condition::validate_satisfy_file_mime
     */
    public function testValidate_satisfy_file_mime() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Validation_Condition::validate_satisfy_file_size
     */
    public function testValidate_satisfy_file_size() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Validation_Condition::validate_satisfy_file_name
     */
    public function testValidate_satisfy_file_name() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Validation_Condition::validate_satisfy_file_name_strict
     */
    public function testValidate_satisfy_file_name_strict() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

}
