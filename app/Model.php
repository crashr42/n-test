<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 4:37 PM
 */

namespace App;

use App\Models\Exceptions\ModelValidationException;
use Illuminate\Contracts\Support\MessageBag;

class Model extends \Eloquent
{
    /**
     * The rules to use for the model validation.
     * Define your validation rules here.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Errors after model validate.
     *
     * @var array
     */
    protected $errors;

    /**
     * Model constructor.
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        $this->errors = new \Illuminate\Support\MessageBag();
    }

    /**
     * Validating object.
     * @return bool
     */
    public function validate()
    {
        $this->fireModelEvent('validating');

        // make a new validator object
        $v = \Validator::make($this->attributes, $this->rules);

        // check for failure
        if ($v->fails()) {
            // set errors and return false
            foreach ($v->errors()->getMessages() as $key => $messages) {
                foreach ($messages as $message) {
                    $this->errors->add($key, $message);
                }
            }

            return false;
        }

        // validation pass
        return true;
    }

    /**
     * @inheritdoc
     */
    public function saveOrFail(array $options = [])
    {
        if (!$this->validate()) {
            throw new ModelValidationException($this);
        }

        return parent::saveOrFail($options);
    }

    /**
     * Returning validation errors.
     * @return array|MessageBag
     */
    public function errors()
    {
        return $this->errors;
    }

    public static function rules()
    {
        return (new static)->rules;
    }
}
