
#Verwendung
```PHP
include_once dirname(__FILE__) . '/../Assistants/vendor/Validation/Validation.php';

$postValidation = Validation::open($_POST)
  ->addSet('action',
           array('set_default'=>'noAction',
                 'satisfy_in_list'=>array('noAction', 'SetPassword', 'SetAccountInfo'),
                 'on_error'=>array('type'=>'error',
                                   'text'=>'unbekannte Aktion'))); 
                                   
$postResults = $postValidation->validate();


if ($postValidation->isValid()){
    echo $postResults['action'];
} else {
  $notifications = $postValidation->getNotifications();
}
```

#Befehle


#### satisfy_exists

siehe [satisfy_isset](#satisfy_isset)

==========================================

#### satisfy_not_exists

siehe [satisfy_not_isset](#satisfy_not_isset)

==========================================

#### satisfy_required

siehe [satisfy_isset](#satisfy_isset)

==========================================

#### satisfy_isset

```PHP
$val->addSet('action',
             array('satisfy_isset'));
```

==========================================

#### satisfy_not_isset

```PHP
$val->addSet('action',
             array('satisfy_not_isset'));

```

==========================================

#### satisfy_not_empty
```PHP
$val->addSet('action',
             array('satisfy_not_empty'));
```

==========================================

#### satisfy_empty
```PHP
$val->addSet('action',
             array('satisfy_empty'));
```

==========================================

#### satisfy_equals_field
```PHP
$val->addSet('newPasswordRepeat',
             array('satisfy_equals_field'=>'newPassword'));

```

==========================================

#### satisfy_not_equals_field

```PHP
$val->addSet('deleteSheetWarning',
             array('satisfy_not_equals_field'=>'deleteSheet'));

```

==========================================

#### satisfy_regex

```PHP
$val->addSet('key',
             array('satisfy_regex'=>'%^([a-zA-Z0-9_]+)$%'));
```

==========================================

#### satisfy_equalTo

siehe [satisfy_value](#satisfy_value)

==========================================

#### satisfy_min_numeric

```PHP
$val->addSet('field',
             array('satisfy_min_numeric'=>0));
```

==========================================

#### satisfy_max_numeric

```PHP
$val->addSet('field',
             array('satisfy_max_numeric'=>100));
```

==========================================

#### satisfy_exact_numeric

```PHP
$val->addSet('field',
             array('satisfy_exact_numeric'=>50));
```

==========================================

#### satisfy_min_len

```PHP
$val->addSet('newPassword',
             array('satisfy_min_len'=>6));

```

==========================================

#### satisfy_max_len

```PHP
$val->addSet('newPassword',
             array('satisfy_max_len'=>255));
```

==========================================

#### satisfy_exact_len

```PHP
$val->addSet('newPassword',
             array('satisfy_exact_len'=>8));
```

==========================================

#### satisfy_in_list

```PHP
$val->addSet('action',
             array('satisfy_in_list'=>array('noAction', 'SetPassword', 'SetAccountInfo')));

```

==========================================

#### satisfy_not_in_list

```PHP
$val->addSet('action',
             array('satisfy_not_in_list'=>array('SetPassword', 'SetAccountInfo')));

```

==========================================

#### satisfy_value

```PHP
$val->addSet('action',
             array('satisfy_value'=>'-1'));
```

==========================================

#### satisfy_file_exists
```PHP

```

==========================================

#### satisfy_file_isset
```PHP

```

==========================================

#### satisfy_file_error
```PHP

```

==========================================

#### satisfy_file_no_error
```PHP

```

==========================================

#### satisfy_file_extension
```PHP

```

==========================================

#### satisfy_file_mime
```PHP

```

==========================================

#### satisfy_file_size
```PHP

```

==========================================

#### satisfy_file_name
```PHP

```

==========================================

#### satisfy_file_name_strict
```PHP

```

==========================================

#### to_float
```PHP

```

==========================================

#### to_string
```PHP

```

==========================================

#### to_lower

```PHP
$val->addSet('externalTypeName',
             ['to_lower']);
```

==========================================

#### to_upper

```PHP
$val->addSet('externalTypeName',
             ['to_upper']);
```

==========================================

#### to_integer

```PHP
$val->addSet('externalType',
             ['to_integer',
              'satisfy_in_list' => [1,2]]);
```

==========================================

#### to_boolean
```PHP

```

==========================================

#### to_md5
```PHP

```

==========================================

#### to_sha1
```PHP

```

==========================================

#### to_base64
```PHP

```

==========================================

#### to_string_from_base64
```PHP

```

==========================================

#### to_object_from_json
```PHP

```

==========================================

#### to_array_from_json
```PHP

```

==========================================

#### to_json

```PHP
$val->addSet('elem',
             array('to_json'));
```

==========================================

#### to_timestamp

```PHP
$val->addSet('startDate',
             array('satisfy_exists',
                   'to_timestamp'));
```

==========================================

#### on_error

```PHP
$val->addSet('action',
             array('satisfy_exists',
                   'on_error'=>array('type'=>'error',
                                     'text'=>'unbekannte Aktion')));
```

==========================================

#### on_no_error

siehe [on_success](#on_success)

==========================================

#### on_success

```PHP
$val->addSet('action',
             array('satisfy_exists',
                   'on_success'=>array('text'=>'Aktion existiert')));
```

==========================================

#### logic_or

```PHP
$val->addSet('key',
             array('logic_or'=>[['satisfy_value'=>''],
                                ['valid_identifier']]));
```

==========================================

#### perform_this_foreach

```PHP
$val->addSet('approvalCondition',
             array('set_default'=>array(),
                   'perform_this_foreach'=>[['key',
                                             ['valid_identifier']],
                                            ['elem',
                                             ['to_integer',
                                              'satisfy_min_numeric'=>0,
                                              'satisfy_max_numeric'=>100]]]));
```

==========================================

#### perform_foreach
```PHP

```

==========================================

#### perform_this_array

```PHP
$val->addSet('proposal',
             ['perform_this_array'=>[[['key_all'],
                                      ['valid_identifier']]]]);
```

==========================================

#### perform_array
```PHP

```

==========================================

#### perform_switch_case

```PHP
$val->addSet('elem',
             ['perform_switch_case'=>[['proposal',
                                       [...]],
                                      ['marking',
                                       [...]]]]);
```

==========================================

#### sanitize_url
```PHP

```

==========================================

#### sanitize
```PHP

```

==========================================

#### set_default
```PHP
$val->addSet('action',
             array('set_default'=>'noAction'));
```

==========================================

#### set_copy
```PHP

```

==========================================

#### set_value
```PHP

```

==========================================

#### set_field_value
```PHP

```

==========================================

#### set_error
```PHP

```

==========================================

#### valid_email
```PHP

```

==========================================

#### valid_url
```PHP

```

==========================================

#### valid_url_query
```PHP

```

==========================================

#### valid_regex
```PHP

```

==========================================

#### valid_hash
```PHP

```

==========================================

#### valid_md5
```PHP

```

==========================================

#### valid_sha1
```PHP

```

==========================================

#### valid_identifier

```PHP
$val->addSet('sortId',
             array('valid_identifier'));

```

==========================================

#### valid_user_name
```PHP

```

==========================================

#### valid_userName
```PHP

```

==========================================

#### valid_timestamp
```PHP

```

==========================================

#### valid_alpha
```PHP

```

==========================================

#### valid_alpha_space
```PHP

```

==========================================

#### valid_integer
```PHP

```

==========================================

#### valid_alpha_numeric
```PHP

```

==========================================

#### valid_alpha_space_numeric
```PHP

```

==========================================

#### valid_json
```PHP

```

==========================================

#### to_structure
```PHP

```

==========================================

#### is_float
```PHP

```

==========================================

#### is_boolean
```PHP

```

==========================================

#### is_integer
```PHP

```

==========================================

#### is_string
```PHP

```

==========================================

#### is_array

```PHP
$val->addSet('rights',
             array('is_array'));
```

==========================================
