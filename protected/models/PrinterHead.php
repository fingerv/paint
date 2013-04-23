<?php
/**
 * This is the model class for table "printer_heads".
 *
 * The followings are the available columns in table 'printers':
 * @property integer $printerId
 * @property integer $headId
 */
class PrinterHead extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'printer_heads';
    }
}