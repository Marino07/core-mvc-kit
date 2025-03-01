<?php

namespace marinopusic\PhpMvcCore\form;

use marinopusic\PhpMvcCore\Model;

abstract class BaseField
{
    public Model $model;
    public string $attribute;

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract public function renderInput(): string;

    public function __toString()
    {
        return sprintf(
            '<div class="form-group">
                <label for="%s">%s</label>
                %s
                <div class="invalid-feedback">%s</div>
            </div>',
            $this->attribute,
            $this->model->labels()[$this->attribute] ?? $this->attribute,
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}
