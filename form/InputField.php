<?php

namespace marinopusic\PhpMvcCore\form;

use marinopusic\PhpMvcCore\Model;

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';


    public string $type;

    /**
     * @param string $type
     */
    public function __construct(Model $model,string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model,$attribute);
    }

    public function passwordField(){
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }


    public function renderInput(): string
    {
        return sprintf('<input type="%s" id="%s" name="%s" value="%s" class="form-control %s">',

            $this->type, // Ovdje je ispravljen redoslijed
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',

        );

    }
}