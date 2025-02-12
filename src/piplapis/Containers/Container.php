<?php

namespace Pipl\Containers;

use Pipl\Fields\Field;
use InvalidArgumentException;

class Container implements \JsonSerializable
{
    // The base class of Record and Person, made only for inheritance.

    public $names = array();
    public $addresses = array();
    public $phones = array();
    public $emails = array();
    public $jobs = array();
    public $ethnicities = array();
    public $origin_countries = array();
    public $languages = array();
    public $educations = array();
    public $images = array();
    public $usernames = array();
    public $user_ids = array();
    public $urls = array();
    public $dob;
    public $gender;

    protected $CLASS_CONTAINER = array(
        'Pipl\Fields\NameField' => 'names',
        'Pipl\Fields\AddressField' => 'addresses',
        'Pipl\Fields\PhoneField' => 'phones',
        'Pipl\Fields\EmailField' => 'emails',
        'Pipl\Fields\JobField' => 'jobs',
        'Pipl\Fields\EthnicityField' => 'ethnicities',
        'Pipl\Fields\OriginCountryField' => 'origin_countries',
        'Pipl\Fields\LanguageField' => 'languages',
        'Pipl\Fields\EducationField' => 'educations',
        'Pipl\Fields\ImageField' => 'images',
        'Pipl\Fields\UsernameField' => 'usernames',
        'Pipl\Fields\UserIdField' => 'user_ids',
        'Pipl\Fields\URLField' => 'urls'
    );

    protected $singular_fields = array(
        'Pipl\Fields\DOBField' => 'dob',
        'Pipl\Fields\GenderField' => 'gender',
    );

    function __construct($fields=array())
    {
        // `fields` is an array of field objects from
        // fields.php.
        $this->add_fields($fields);
    }

    public function add_fields($fields)
    {
        // Add the fields to their corresponding container.
        // `fields` is an array of field objects from fields.php
        if (empty($fields))
        {
            return;
        }

        foreach ($fields as $field)
        {
            $cls = is_object($field) ? get_class($field) : NULL;

            if (array_key_exists($cls, $this->CLASS_CONTAINER))
            {
                $container = $this->CLASS_CONTAINER[$cls];
                $this->{$container}[] = $field;
            } elseif(array_key_exists($cls, $this->singular_fields)) {
                $this->{$this->singular_fields[$cls]} = $field;
            } else {
                $type = empty($cls) ? gettype($field) : $cls;
                throw new InvalidArgumentException('Object of type ' . $type . ' is an invalid field');
            }
        }
    }

    public function all_fields()
    {
        // An array with all the fields contained in this object.
        $allfields = array();
        foreach (array_values($this->CLASS_CONTAINER) as $val){
            $allfields = array_merge($allfields, $this->{$val});
        }
        foreach (array_values($this->singular_fields) as $val){
            if($this->{$val}) {
                $allfields[] = $this->{$val};
            }
        }

        return $allfields;
    }

    public function fields_from_array($d)
    {
        // Load the fields from the dict, return an array with all the fields.

        $fields = array();

        foreach (array_keys($this->CLASS_CONTAINER) as $field_cls){
            $container = $this->CLASS_CONTAINER[$field_cls];
            if (array_key_exists($container, $d)) {
                $field_array = $d[$container];
                foreach ($field_array as $x) {
                    $from_array_func = method_exists($field_cls, 'from_array') ? array($field_cls, 'from_array') : array(Field::class, 'from_array');
                    $fields[] = call_user_func($from_array_func, $field_cls, $x);
                }
            }
        }
        foreach (array_keys($this->singular_fields) as $field_cls){
            $container = $this->singular_fields[$field_cls];
            if (array_key_exists($container, $d)) {
                $field_array = $d[$container];
                $from_array_func = method_exists($field_cls, 'from_array') ? array($field_cls, 'from_array') : array(Field::class, 'from_array');
                $fields[] = call_user_func($from_array_func, $field_cls, $field_array);
            }
        }
        return $fields;
    }

    public function fields_to_array(){
        // Transform the object to an array and return it.
        $d = array();

        foreach (array_values($this->CLASS_CONTAINER) as $container){
            $fields = $this->{$container};
            if (!empty($fields)){
                $all_fields = array();
                foreach($fields as $field) {
                    $all_fields[] = $field->to_array();
                }
                if (count($all_fields) > 0){
                    $d[$container] = $all_fields;
                }
            }
        }
        foreach (array_values($this->singular_fields) as $container){
            $field = $this->{$container};
            if (!empty($field)){
                $d[$container] =  $field->to_array();
            }
        }
        return $d;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return $this->to_array();
    }
}