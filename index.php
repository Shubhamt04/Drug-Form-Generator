<?php

$drugFieldData = json_decode(file_get_contents('drug1.json'));

$formHtml = '<form action="">';
$requiredOrReadOnly = '';
foreach($drugFieldData->fields as $field){
    $requiredOrReadOnly = $field->isReadonly ? 'readonly' : '';
    $requiredOrReadOnly .= empty($requiredOrReadOnly) ? ($field->isRequired  ? 'required' : '') : ($field->isRequired  ? ' required' : '');
    // $isRequired = $field->isRequired ? 'required' : '';
    if($field->type == 'number' || $field->type == 'date'){
        $formHtml .= '<label>'.$field->label.'</label><br>';
        $formHtml .= '<input type="'.$field->type.'" name="'.$field->key.'" id="'.$field->key.'" '.$requiredOrReadOnly.' ><br>';
    } elseif($field->type == 'dropdown'){
        $formHtml .= '<label>'.$field->label.'</label><br>';
        $formHtml .= '<select name="'.$field->key.'" id="'.$field->key.'" '.$requiredOrReadOnly.'><option value="-1">Select</option>';
        foreach($field->items as $option){
            $formHtml .= '<option value="'.$option->value.'">'.$option->value.'</option>';
        }
        $formHtml .= '</select></br>';
    }
}
$formHtml .= '<input type="submit" value="Submit">';
$formHtml .= '</form>';
echo $formHtml;

?>