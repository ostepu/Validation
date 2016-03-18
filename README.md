
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
// das Feld $_POST['action'] muss gesetzt sein
$val = Validation::open($_POST);
$val->addSet('action',
             array('satisfy_isset'));
```

==========================================

#### satisfy_not_isset

```PHP
// das Feld $_POST['action'] darf nicht gesetzt sein
$val = Validation::open($_POST);
$val->addSet('action',
             array('satisfy_not_isset'));

```

==========================================

#### satisfy_not_empty

```PHP
// das Feld $_POST['action'] darf nicht leer sein
$val = Validation::open($_POST);
$val->addSet('action',
             array('satisfy_not_empty'));
```
siehe [empty](http://php.net/manual/de/function.empty.php)

==========================================

#### satisfy_empty

```PHP
// das Feld $_POST['action'] muss leer sein
$val = Validation::open($_POST);
$val->addSet('action',
             array('satisfy_empty'));
```
siehe [empty](http://php.net/manual/de/function.empty.php)

==========================================

#### satisfy_equals_field
```PHP
// das Feld $_POST['newPasswordRepeat'] soll den selben Inhalt
// wie das Feld $_POST['newPassword'] haben
$val = Validation::open($_POST);
$val->addSet('newPasswordRepeat',
             array('satisfy_equals_field'=>'newPassword'));

```

==========================================

#### satisfy_not_equals_field

```PHP
// das Feld $_POST['newPasswordRepeat'] darf nicht den selben
// Inhalt wie das Feld $_POST['newPassword'] haben
$val = Validation::open($_POST);
$val->addSet('deleteSheetWarning',
             array('satisfy_not_equals_field'=>'deleteSheet'));

```

==========================================

#### satisfy_regex

```PHP
// das Feld $_POST['key'] muss den regulären Ausdruck
// %^([a-zA-Z0-9_]+)$% erfüllen
$val = Validation::open($_POST);
$val->addSet('key',
             array('satisfy_regex'=>'%^([a-zA-Z0-9_]+)$%'));
```
siehe [PCRE](http://php.net/manual/de/reference.pcre.pattern.syntax.php)

==========================================

#### satisfy_equalTo

siehe [satisfy_value](#satisfy_value)

==========================================

#### satisfy_min_numeric

```PHP
// das Feld $_POST['field'] soll >= 0 sein
$val = Validation::open($_POST);
$val->addSet('field',
             array('satisfy_min_numeric'=>0));
```

==========================================

#### satisfy_max_numeric

```PHP
// das Feld $_POST['field'] soll <= 100 sein
$val = Validation::open($_POST);
$val->addSet('field',
             array('satisfy_max_numeric'=>100));
```

==========================================

#### satisfy_exact_numeric

```PHP
// das Feld $_POST['field'] soll genau 50 sein
$val = Validation::open($_POST);
$val->addSet('field',
             array('satisfy_exact_numeric'=>50));
```

==========================================

#### satisfy_min_len

```PHP
// die Länge des Feldes $_POST['newPassword']
// soll >= 6 sein
$val = Validation::open($_POST);
$val->addSet('newPassword',
             array('satisfy_min_len'=>6));

```

==========================================

#### satisfy_max_len

```PHP
// die Länge des Feldes $_POST['newPassword']
// soll <= 255 sein
$val = Validation::open($_POST);
$val->addSet('newPassword',
             array('satisfy_max_len'=>255));
```

==========================================

#### satisfy_exact_len

```PHP
// die Länge des Feldes $_POST['newPassword']
// soll genau 8 sein
$val = Validation::open($_POST);
$val->addSet('newPassword',
             array('satisfy_exact_len'=>8));
```

==========================================

#### satisfy_in_list

```PHP
// das Feld $_POST['action'] soll einen der
// Werte 'SetPassword' oder 'SetAccountInfo' enthalten
// und wenn es nicht gesetzt ist 'noAction'
$val = Validation::open($_POST);
$val->addSet('action',
             array('satisfy_in_list'=>array('noAction', 'SetPassword', 'SetAccountInfo')));

```

==========================================

#### satisfy_not_in_list

```PHP
// das Feld $_POST['action'] darf nicht die Werte
// 'SetPassword' oder 'SetAccountInfo' haben
$val = Validation::open($_POST);
$val->addSet('action',
             array('satisfy_not_in_list'=>array('SetPassword', 'SetAccountInfo')));

```

==========================================

#### satisfy_value

```PHP
// das Feld $_POST['action'] muss den
// Wert -1 haben
$val = Validation::open($_POST);
$val->addSet('action',
             array('satisfy_value'=>'-1'));
```

==========================================

#### satisfy_file_exists

```PHP
// die hochgeladene Datei in $_FILES['MarkingFile']
// soll existieren
$val = Validation::open($_FILES);
$val->addSet('MarkingFile',
             ['satisfy_file_exists']);

```
siehe [file_exists](http://php.net/manual/de/function.file-exists.php)

==========================================

#### satisfy_file_isset

```PHP
// die notwendigen Felder der hochgeladenen Datei
// sollen in $_FILES['MarkingFile'] gesetzt sein
$val = Validation::open($_FILES);
$val->addSet('MarkingFile',
             ['satisfy_file_isset']);

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
// die hochgeladene Datei in $_FILES['MarkingFile'] soll
// die Dateiendung .zip besitzen
$val = Validation::open($_FILES);
$val->addSet('MarkingFile',
             ['satisfy_file_extension'=>'zip']);

```

==========================================

#### satisfy_file_mime

```PHP
// die hochgeladene Datei in $_FILES['MarkingFile'] soll
// den Strukturtyp application/zip haben
$val = Validation::open($_FILES);
$val->addSet('MarkingFile',
             ['satisfy_file_mime'=>'application/zip']);

```
siehe [mime-Typen](https://wiki.selfhtml.org/wiki/Referenz:MIME-Typen)

==========================================

#### satisfy_file_size

```PHP
// nicht implementiert
```

==========================================

#### satisfy_file_name

```PHP
// die hochgeladene Datei in $_FILES['MarkingFile'] soll
// den Dateiname upload.zip haben
$val = Validation::open($_FILES);
$val->addSet('MarkingFile',
             ['satisfy_file_name'=>'upload.zip']);
```

==========================================

#### satisfy_file_name_strict

```PHP
// die hochgeladene Datei in $_FILES['MarkingFile'] darf
// im Dateinamen nur die Zeichen a-z,A-z,0-9 und .-_ enthalten
$val = Validation::open($_FILES);
$val->addSet('MarkingFile',
             ['satisfy_file_name_strict']);
```

==========================================

#### to_float

```PHP
// wandelt $_POST['field'] in eine Gleitkommazahl um
$val = Validation::open($_POST);
$val->addSet('field',
             ['to_float']);
```

==========================================

#### to_string

```PHP
// wandelt $_POST['field'] in einen String um
$val = Validation::open($_POST);
$val->addSet('field',
             ['to_string']);
```

==========================================

#### to_lower

```PHP
// wandelt $_POST['externalTypeName'] in
// Kleinbuchstaben um
$val = Validation::open($_POST);
$val->addSet('externalTypeName',
             ['to_lower']);
```

==========================================

#### to_upper

```PHP
// wandelt $_POST['externalTypeName'] in
// Großbuchstaben um
$val = Validation::open($_POST);
$val->addSet('externalTypeName',
             ['to_upper']);
```

==========================================

#### to_integer

```PHP
$val = Validation::open($_POST);
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
// kodiert $_POST['field'] mittels md5
$val->addSet('field',
             ['to_md5');
```
siehe [md5](http://php.net/manual/de/function.md5.php)

==========================================

#### to_sha1
```PHP
// kodiert $_POST['field'] mittels sha1
$val->addSet('field',
             ['to_sha1');
```
siehe [sha1](http://php.net/manual/de/function.sha1.php)

==========================================

#### to_base64
```PHP
// kodiert $_POST['field'] mittels base64
$val->addSet('field',
             ['to_base64');
```
siehe [base64_encode](http://php.net/manual/de/function.base64-encode.php)

==========================================

#### to_string_from_base64
```PHP
// wandelt das base64 kodierte Feld $_POST['field']
// in einen String um
$val->addSet('field',
             ['to_string_from_base64');
```
siehe [base64_decode](http://php.net/manual/de/function.base64-decode.php)

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
// $_POST['elem'] soll im json-Format serialisiert werden
$val = Validation::open($_POST);
$val->addSet('elem',
             array('to_json'));
```
siehe [json_encode](http://php.net/manual/de/function.json-encode.php)

==========================================

#### to_timestamp

```PHP
// $_POST['startDate'] soll in einen unix-Zeitstempel umgewandelt werden
$val = Validation::open($_POST);
$val->addSet('startDate',
             array('satisfy_exists',
                   'to_timestamp'));
```

==========================================

#### on_error

```PHP
// das Feld $_POST['action'] soll existieren, ansonsten
// soll eine Fehlermeldung generiert werden
$val = Validation::open($_POST);
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
// wenn das Feld $_POST['action'] existiert, soll eine
// Erfolgsmeldung erzeugt werden (kein Abbruch)
$val = Validation::open($_POST);
$val->addSet('action',
             array('satisfy_exists',
                   'on_success'=>array('text'=>'Aktion existiert')));
```

==========================================

#### logic_or

```PHP
// das Feld $_POST['key'] darf entweder ein gültiger identifier
// oder der leere String sein
$val = Validation::open($_POST);
$val->addSet('key',
             array('logic_or'=>[['satisfy_value'=>''],
                                ['valid_identifier']]));
```

==========================================

#### perform_this_foreach

```PHP
// alle Schlüssel des Arrays $_POST['approvalCondition'] sollen gültige
// identifiert sein und alle darin enthaltenen Elemente zwischen
// 0 und 100 liegen
$val = Validation::open($_POST);
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
// die Elemente des Arrays $_POST['proposal'] sollen
// gültige identifiert sein
$val = Validation::open($_POST);
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
// es sollen die Felder $_POST['elem']['proposal'] und
// $_POST['elem']['marking'] geprüft werden
$val = Validation::open($_POST);
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
// wenn der Wert $_POST['action'] nicht gesetzt ist
// soll er 'noAction' sein
$val = Validation::open($_POST);
$val->addSet('action',
             array('set_default'=>'noAction'));
```

==========================================

#### set_copy
```PHP
// erstellt das Feld $_POST['newField'] und kopiert
// dort $_POST['oldField'] hinein
$val = Validation::open($_POST);
$val->addSet('oldField',
             array('set_copy'=>'newField'));
```

==========================================

#### set_value
```PHP
// setzt den Wert des Feldes $_POST['field']
// auf 1234
$val = Validation::open($_POST);
$val->addSet('field',
             array('set_value'=>'1234'));
```

==========================================

#### set_field_value
```PHP
// setzt den Wert des Feldes $_POST['field']
// auf $_POST['otherField']
$val = Validation::open($_POST);
$val->addSet('field',
             array('set_field_value'=>'otherField'));
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
// das Feld $_POST['sortId'] darf nur 0-9 und _ enthalten
$val = Validation::open($_POST);
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
// das Feld $_POST['rights'] muss ein Array sein
$val = Validation::open($_POST);
$val->addSet('rights',
             array('is_array'));
```

==========================================
