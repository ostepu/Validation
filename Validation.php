<?php
/**
 * @file Validation.php
 * Contains the Validation class
 *
 * @author Till Uhlig
 */

include_once dirname(__FILE__) . '/Validation_Interface.php';
include_once dirname(__FILE__) . '/validator/Validation_Structure.php';
include_once dirname(__FILE__) . '/validator/Validation_Converter.php';
include_once dirname(__FILE__) . '/validator/Validation_Event.php';
include_once dirname(__FILE__) . '/validator/Validation_Perform.php';
include_once dirname(__FILE__) . '/validator/Validation_Logic.php';
include_once dirname(__FILE__) . '/validator/Validation_Set.php';
include_once dirname(__FILE__) . '/validator/Validation_Sanitize.php';
include_once dirname(__FILE__) . '/validator/Validation_Type.php';
include_once dirname(__FILE__) . '/validator/Validation_Condition.php';
include_once dirname(__FILE__) . '/selector/Selection_Key.php';
include_once dirname(__FILE__) . '/selector/Selection_Elem.php';

class Validation
{
    private $_input = array();

    /**
     * The values that were found in the input.
     *
     * @var array $foundValues After evaluation this contains the values that
     * were found in the input.
     * @see Validation::validate()
     */
    private $_foundValues = array();
    private $_notifications = array();
    private $_errors = array();
    private $_validated = null;

    private $_validationRules = array();
    private $_customValidation = array();
    private $_customValidationClasses = array();
    private $_customSelection = array();
    private $_customSelectionClasses = array();

    private $_settings = array('preRules' => array(),
                               'postRules' => array(),
                               'abortSetOnError'=>false,
                               'abortValidationOnError'=>false);

    /**
     * [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function resetErrors()
    {
        $this->_errors = array();
        return $this;
    }

    /**
     * [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function resetResult()
    {
        $this->_foundValues = array();
        return $this;
    }

    /**
     * [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function resetValidationRules()
    {
        $this->_validationRules = array();
        return $this;
    }

    /**
     * [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function getResult()
    {
        return $this->_foundValues;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $rules [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function convertRules($rules)
    {
        $tempRules = array();
        if (!is_array($rules)) {
            $rules = array($rules);
        }

        foreach ($rules as $ruleName => $ruleParams) {
            if (is_int($ruleName)) {
                $tempRules[] = array($ruleParams, null);
            } else {
                $tempRules[] = array($ruleName, $ruleParams);
            }
        }
        return $tempRules;
    }
    /**
     * [[Description]]
     * @param  [[Type]] $rules [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function convertSelector($rules)
    {
        $tempRules = array();
        if (!is_array($rules)) {
            $rules = array('key'=>$rules);
        }

        foreach ($rules as $ruleName => $ruleParams) {
            if (is_int($ruleName)) {
                $tempRules[] = array($ruleParams, null);
            } else {
                $tempRules[] = array($ruleName, $ruleParams);
            }
        }
        return $tempRules;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $fieldNames [[Description]]
     * @param  [[Type]] $rules      [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function addSet($fieldNames, $rules)
    {
        $convertedSelector = $this->convertSelector($fieldNames);
        $name = md5(json_encode($convertedSelector));

        if (!isset($this->_validationRules[$name])) {
            $this->_validationRules[$name] = array(
                $convertedSelector,
                array_merge(
                    $this->convertRules($this->_settings['preRules']),
                    $this->convertRules($rules)
                )
            );
        } else {
            $this->_validationRules[$name][1] = array_merge(
                $this->_validationRules[$name][1],
                $this->convertRules($rules)
            );
        }

        $this->_validated = null;
        return $this;
    }

    /**
     * [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function getNotifications()
    {
        return $this->_notifications;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $callback [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function getPrintableNotifications($callback)
    {
        $temp = array();
        $notes = $this->getNotifications();
        foreach ($notes as $note) {
            $temp[] = $callback($note['type'], $note['text']);
        }
        return $temp;
    }

    /**
     * [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function resetNotifications()
    {
        $this->_notifications = array();
        return $this;
    }

    private static $_validatorClasses = array('Validation_Structure'=>null,
                                              'Validation_Converter'=>null,
                                              'Validation_Event'=>null,
                                              'Validation_Set'=>null,
                                              'Validation_Perform'=>null,
                                              'Validation_Sanitize'=>null,
                                              'Validation_Condition'=>null,
                                              'Validation_Type'=>null,
                                              'Validation_Logic'=>null);
    private static $_selectionClasses = array('Selection_Key'=>null,
                                              'Selection_Elem'=>null);

    /**
     * [[Description]]
     * @param  [[Type]] $name     [[Description]]
     * @param  [[Type]] $callback [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function addValidator($name, $callback)
    {
        if (isset($this->_customValidation[$name])) {
            throw new Exception(
                "Validation rule '{$methodName}' already exists (custom)."
            );
        }

        $methods = array();
        foreach (array_keys(self::$_validatorClasses) as $class) {
            $methods = array_merge(
                $methods,
                get_class_methods($class)
            );
        }

        foreach ($this->_customValidationClasses as $class) {
            $methods = array_merge(
                $methods,
                get_class_methods($class)
            );
        }

        $methodName = 'validate_'.$name;

        if (in_array($methodName, $methods)) {
            throw new Exception(
                "Validation rule '{$methodName}' already exists (static)."
            );
        }

        $this->_customValidation[$name] = $callback;
        return $this;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $name [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function addValidationClass($name)
    {
        $this->_customValidationClasses[$name] = $name::getIndicator();
        return $this;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $name     [[Description]]
     * @param  [[Type]] $callback [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function addSelector($name, $callback)
    {
        if (isset($this->_customSelection[$name])) {
            throw new Exception(
                "Selector rule '{$methodName}' already exists (custom)."
            );
        }

        $methods = array();
        foreach (array_keys(self::$_selectionClasses) as $class) {
            $methods = array_merge(
                $methods,
                get_class_methods($class)
            );
        }

        foreach ($this->_customSelectionClasses as $class) {
            $methods = array_merge(
                $methods,
                get_class_methods($class)
            );
        }

        $methodName = 'select_'.$name;

        if (in_array($methodName, $methods)) {
            throw new Exception(
                "Selector rule '{$methodName}' already exists (static)."
            );
        }

        $this->_customSelection[$name] = $callback;
        return $this;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $name [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function addSelectionClass($name)
    {
        $this->_customSelectionClasses[$name] = $name::getIndicator();
        return $this;
    }

    /**
     * Construct a new Validation.
     *
     * @param array $input The values.
     */
    public function __construct($input=null, $settings = array())
    {
        if (isset($input)) {
            if (!is_array($input)){
                $input = array($input);
            }
            
            $this->_input = array_merge($this->_input, $input);
        } else {
            $input = array();
        }

        $this->_settings = array_merge($this->_settings, $settings);

        foreach (self::$_validatorClasses as $class => $indicator) {
           self::$_validatorClasses[$class] = $class::getIndicator();
        }

        foreach (self::$_selectionClasses as $class => $indicator) {
           self::$_selectionClasses[$class] = $class::getIndicator();
        }

        return $this;
    }

    /**
     * [[Description]]
     * @param  [[Type]] [$input=null]         [[Description]]
     * @param  [[Type]] [$settings = array()] [[Description]]
     * @return [[Type]] [[Description]]
     */
    public static function open($input=null, $settings = array())
    {
        $temp = new Validation($input, $settings);

        return $temp;
    }

    /**
     * [[Description]]
     */
    public function close()
    {
        $this->_input = array();
        $this->_validationRules = array();
        $this->_customValidation = array();
        $this->_customValidationClasses = array();
        $this->_customSelection = array();
        $this->_customSelectionClasses = array();
        $this->_settings = array('preRules' => array(),
                                'postRules' => array(),
                                'abortSetOnError'=>false,
                                'abortValidationOnError'=>false);

    }

    /**
     * [[Description]]
     * @param  [[Type]] $ruleName [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function findValidator($ruleName)
    {
        if (trim($ruleName) === '') {
            return null;
        }

        $validatorFunction = null;

        if (isset($this->_customValidation[$ruleName])) {
            if (is_callable($this->_customValidation[$ruleName])) {
                $validatorFunction = $this->_customValidation[$ruleName];
            } else {
                throw new Exception(
                    "Validation '{$ruleName}' is not callable (custom)."
                );
            }
        } else {
            $indicator = explode('_', $ruleName);
            if (isset($indicator[0])) {
                $indicator = $indicator[0];
            } else {
                throw new Exception(
                    "invalid rule name '{$ruleName}'."
                );
            }

            $possibleClasses = array();
            foreach (self::$_validatorClasses as $class => $classIndicator) {
                if ($classIndicator === $indicator) {
                    $possibleClasses[] = $class;
                }
            }

            foreach ($this->_customValidationClasses as
                     $class => $classIndicator) {
                if ($classIndicator === $indicator) {
                    $possibleClasses[] = $class;
                }
            }

            if (empty($possibleClasses)) {
                throw new Exception(
                    "Invalid indicator '{$indicator}'."
                );
            }

            $found = false;
            foreach ($possibleClasses as $class) {
                if (is_callable($class.'::validate_'.$ruleName)) {
                    $validatorFunction = $class.'::validate_'.$ruleName;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                throw new Exception(
                    "Validation '".$class.'::validate_'.
                    $ruleName."' does not exists."
                );
            }
        }

        return $validatorFunction;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $ruleName [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function findSelector($ruleName)
    {
        if (trim($ruleName) === '') {
            return null;
        }

        $selectionFunction = null;

        if (isset($this->_customSelection[$ruleName])) {
            if (is_callable($this->_customSelection[$ruleName])) {
                $selectionFunction = $this->_customSelection[$ruleName];
            } else {
                throw new Exception(
                    "Selection '{$ruleName}' is not callable (custom)."
                );
            }
        } else {
            $indicator = explode('_', $ruleName);
            if (isset($indicator[0])) {
                $indicator = $indicator[0];
            } else {
                throw new Exception(
                    "invalid rule name '{$ruleName}'."
                );
            }

            $possibleClasses = array();
            foreach (self::$_selectionClasses as
                     $class => $classIndicator) {
                if ($classIndicator === $indicator) {
                    $possibleClasses[] = $class;
                }
            }

            foreach ($this->_customSelectionClasses as
                     $class => $classIndicator) {
                if ($classIndicator === $indicator) {
                    $possibleClasses[] = $class;
                }
            }

            if (empty($possibleClasses)) {
                throw new Exception("Invalid indicator '{$indicator}'.");
            }

            $found = false;
            foreach ($possibleClasses as $class) {
                if (is_callable($class.'::select_'.$ruleName)) {
                    $selectionFunction = $class.'::select_'.$ruleName;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                throw new Exception(
                    "Selection '".$class.'::select_'.
                    $ruleName."' does not exists."
                );
            }
        }

        return $selectionFunction;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $fieldNames [[Description]]
     * @param  [[Type]] $selectors  [[Description]]
     * @return boolean  [[Description]]
     */
    public function collectKeys($fieldNames, $selectors)
    {
        foreach ($selectors as $rule) {
            $ruleName = $rule[0];
            $ruleParam = $rule[1];

            $callable = $this->findSelector($ruleName);

            if ($callable === null) {
                continue;
            }

            $res = call_user_func(
                $callable,
                $fieldNames,
                $this->_input,
                $this->_settings,
                $ruleParam
            );

            if (is_array($res) || $res === false) {
                if (isset($res['notification'])) {
                    $this->_notifications[] = $res['notification'];
                }
                
                if (isset($res['notifications'])) {
                    $this->_notifications = array_merge($this->_notifications, $res['notifications']);
                }

                if (isset($res['errors'])) {
                    $this->_errors = array_merge(
                        $this->_errors,
                        $res['errors']
                    );
                }

                if (isset($res['keys'])) {
                    $fieldNames = $res['keys'];
                }

                if ($this->_settings['abortSetOnError'] ||
                    (isset($res['abortSet']) && $res['abortSet'] === true)) {
                    break;
                } elseif ($this->_settings['abortValidationOnError'] ||
                          (isset($res['abortValidation']) &&
                           $res['abortValidation'] === true)) {
                    $this->resetResult();
                    $this->resetValidationRules();
                    $this->_validated=false;
                    return false;
                }
            }
        }

        return $fieldNames;
    }

    /**
     * [[Description]]
     * @param  [[Type]] [$input = null] [[Description]]
     * @return boolean  [[Description]]
     */
    public function isValid($input = null)
    {
        if ($this->_validated !== null) {
            return $this->_validated;
        }

        if (isset($input)) {
            $this->_input = array_merge($this->_input, $input);
        }

        $this->_settings = array_merge(
            $this->_settings,
            array('setError' => false, 'validationError' => false)
        );

        foreach ($this->_validationRules as $set) {
            $selector = $set[0];
            $ruleSet = $set[1];

            $setParameters = array_merge(
                $ruleSet,
                $this->convertRules($this->_settings['postRules'])
            );

            $validRuleSet = true;
            $this->_settings['setError'] = false;

            $fieldNames = $this->collectKeys(
                array_keys($this->_input),
                $selector
            );

            if ($fieldNames === false) {
                return false;
            }


            foreach ($fieldNames as $fieldName) {
                $abort = false;

                foreach ($setParameters as $rule) {
                    $ruleName = $rule[0];
                    $ruleParam = $rule[1];

                    $callable = $this->findValidator($ruleName);

                    if ($callable === null) {
                        continue;
                    }

                   $res = call_user_func(
                       $callable,
                       $fieldName,
                       $this->_input,
                       $this->_settings,
                       $ruleParam
                   );

                    if (is_array($res) || $res === false) {
                        if (isset($res['notification'])) {
                            $this->_notifications[] = $res['notification'];
                        }
                
                        if (isset($res['notifications'])) {
                            $this->_notifications = array_merge($this->_notifications, $res['notifications']);
                        }

                        if (isset($res['errors'])) {
                            $this->_errors = array_merge(
                                $this->_errors,
                                $res['errors']
                            );
                        }

                        if (!isset($res['valid']) || $res['valid'] === false) {
                            $validRuleSet = false;
                            $this->_settings['setError'] = true;
                            $this->_settings['validationError'] = true;

                            $value = (isset($this->_input[$fieldName]) ?
                                      $this->_input[$fieldName] :
                                      null);
                            $this->_errors[] = array('field'=>$fieldName,
                                                    'value'=>$value,
                                                    'rule'=>$ruleName);

                        } elseif (isset($res['valid']) &&
                                  $res['valid'] === true) {
                            if (isset($res['field']) && isset($res['value'])) {
                                $this->_input[$res['field']] = $res['value'];
                                $this->insertValue($fieldName, $res['value']);
                            }

                            if (isset($res['fields'])) {
                                if (!is_array($res['fields'])) {
                                    throw new Exception(
                                        'Validation rule \''.__METHOD__.
                                        '\', array expected.'
                                    );
                                }
                                foreach ($res['fields'] as $field => $value) {
                                    $this->_input[$field] = $value;
                                    $this->insertValue($field, $value);
                                }
                            }
                        }

                        if ($this->_settings['abortSetOnError'] ||
                            (isset($res['abortSet']) &&
                             $res['abortSet'] === true)) {
                            $abort = true;
                            break;
                        } elseif ($this->_settings['abortValidationOnError'] ||
                                  (isset($res['abortValidation']) &&
                                   $res['abortValidation'] === true)) {
                            $this->resetResult();
                            $this->resetValidationRules();
                            $this->_validated=false;
                            return false;
                        }
                    }
                }

                if ($abort === true) {
                    break;
                }
            }

            if ($validRuleSet === true) {
                $this->insertValue(
                    $fieldName,
                    (isset($this->_input[$fieldName]) ?
                     $this->_input[$fieldName] :
                     null)
                );
            } else {
                $this->removeValue($fieldName);
            }
        }

        if ($this->_settings['validationError'] === false) {
            $this->resetValidationRules();
            $this->_validated=true;
            return true;
        }

        $this->resetResult();
        $this->resetValidationRules();
        $this->_validated=false;
        return false;
    }

    /**
     * [[Description]]
     * @return boolean [[Description]]
     */
    public function validate()
    {
        if ($this->isValid()) {
            return $this->getResult();
        }
        return false;
    }

    /**
     * [[Description]]
     * @param  [[Type]] $value [[Description]]
     * @param  [[Type]] $rules [[Description]]
     * @return [[Type]] [[Description]]
     */
    public static function validateValue($value, $rules)
    {
        $tmp = new static(array('elem'=>$value));
        $tmp->addSet('elem', $rules);

        if ($tmp->isValid()) {
            $value = $tmp->getResult();
            return new ValidationResult(true, $value['elem']);
        }
        return new ValidationResult(false, null);
    }

    /**
     * [[Description]]
     * @param [[Type]] $key   [[Description]]
     * @param [[Type]] $value [[Description]]
     */
    private function insertValue($key, $value)
    {
        $this->_foundValues[$key] = $value;
    }

    /**
     * [[Description]]
     * @param [[Type]] $key [[Description]]
     */
    private function removeValue($key)
    {
        if (isset($this->_foundValues[$key])) {
            unset($this->_foundValues[$key]);
        }
    }

    /**
     * [[Description]]
     * @param  [[Type]] $key [[Description]]
     * @return boolean  [[Description]]
     */
    private function isValue($key)
    {
        if (isset($this->_foundValues[$key])) {
            return true;
        }
        return false;
    }
}

class ValidationResult
{
    private $_isValid = true;
    private $_value = null;

    /**
     * [[Description]]
     * @param [[Type]] [$isValid=true] [[Description]]
     * @param [[Type]] [$value = null] [[Description]]
     */
    public function __construct($isValid=true, $value = null)
    {
        $this->_isValid = $isValid;
        $this->_value = $value;
    }

    /**
     * [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function isValid()
    {
        return $this->_isValid;
    }

    /**
     * [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function getResult()
    {
        return $this->_value;
    }

}