<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 4/18/17
 * Time: 11:25 AM
 */

namespace Modularization\Ingredients;


class Form
{
    public $formGroup = '   _formGroup_: FormGroup;';
    public $formControl = '   _formControl_: FormControl;';
    public $formData = '    _formData_: FormData;';
    public $createFormData = "  this._formControl_ = new FormControl('', [Validators.required]]);";
}