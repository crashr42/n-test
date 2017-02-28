<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 4:41 PM
 */

namespace App\Models\Exceptions;

use App\Model;
use Illuminate\Contracts\Support\MessageBag;

class ModelValidationException extends \Exception
{
    /**
     * @var MessageBag
     */
    private $model;

    /**
     * ModelValidationException constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct('', 0, null);

        $this->model = $model;
    }

    /**
     * Errors messages.
     *
     * @return MessageBag
     */
    public function errors()
    {
        return $this->model->errors();
    }
}
