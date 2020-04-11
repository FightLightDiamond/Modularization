<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 4/18/17
 * Time: 4:34 PM
 */

namespace Cuongpm\Modularization\Core\Components;

use Cuongpm\Modularization\Http\Facades\DBFa;
use Cuongpm\Modularization\Helpers\DecoHelper;
use Cuongpm\Modularization\Ingredients\Form;

class FormBuilderComponent extends BaseComponent
{
    protected $ingredient;
    protected $columns;
    protected $source;

    public function __construct(Form $form)
    {
        $this->ingredient = $form;
        $this->source = file_get_contents($this->getSource());
    }

    private function getSource()
    {
        return $this->getViewPath('/ng/form/builder.txt');
    }

    private function getColumns($table)
    {
        return DBFa::getDataTypes($table);
    }

    private function buildFormData($table)
    {
        $table = 'form' . Str::ucfirst($table) . 'Data';
        $material = str_replace(DecoHelper::FORM_DATA, $table, $this->ingredient->formData);
        $this->working(DecoHelper::FORM_DATA, $material);
    }

    private function buildFormControl($table)
    {
        $filed = '';
        foreach ($this->getColumns($table) as $column => $type) {
            $filed .= str_replace(DecoHelper::FORM_CONTROL, $column, $this->ingredient->formControl) . "\n";
        }
        $this->working(DecoHelper::FORM_CONTROL, $filed);
    }

    private function buildFormGroup($table)
    {
        $table = 'form' . Str::ucfirst($table) . 'Group';
        $material = str_replace(DecoHelper::FORM_GROUP, $table, $this->ingredient->formGroup);
        $this->working(DecoHelper::FORM_GROUP, $material);
    }

    private function buildCreateFormControl($table)
    {
        $filed = '';
        foreach ($this->getColumns($table) as $column => $type) {
            $filed .= str_replace(DecoHelper::FORM_CONTROL, $column, $this->ingredient->createFormData) . "\n";
        }
        $this->working(DecoHelper::CREATE_FORM_CONTROL, $filed);
    }

    private function buildCreateFormGroup($table)
    {
        $filed = '';
        foreach ($this->getColumns($table) as $column => $type) {
            $filed .= $column . ' = $this.' . $column . ",\n";
        }
        $this->working(DecoHelper::CREATE_FORM_GROUP, $filed);
    }

    public function building($table)
    {
        $this->buildFormData($table);
        $this->buildFormControl($table);
        $this->buildFormGroup($table);
        $this->buildCreateFormControl($table);
        $this->buildCreateFormGroup($table);
        return $this->source;
    }
}
