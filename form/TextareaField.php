<?php

namespace app\core\form;

class TextareaField extends BaseField
{
    public function renderInput(): string
    {
        return sprintf(
            '<textarea name="%s" id="%s" class="form-control%s">%s</textarea>',
            $this->attribute,
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            htmlspecialchars($this->model->{$this->attribute}) // Use htmlspecialchars to escape any special characters
        );
    }
}
