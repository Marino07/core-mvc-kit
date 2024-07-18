<?php

namespace marinopusic\PhpMvcCore;

use marinopusic\PhpMvcCore\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName():string;

}