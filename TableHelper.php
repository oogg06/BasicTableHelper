<?php
App::uses('AppHelper', 'View/Helper');

class TableHelper extends AppHelper{
    private $_model=null;
    private $_modelName="";
    private $_fields=array();
    private $_labels=array();
    private $_table_element="<table>";
    private $row_element="<tr>";
    private $data_element="<td>";
    private function setName($modelName){
        
        $this->_modelName=$modelName;
    }
    private function _show($element, $text){
        echo "<h3>$text</h3>";
        echo "<pre>";
        var_dump($element);
        echo "</pre>";
        echo "<h3>End of $text</h3><br/>";
    }
    private function setModel($model,$options){
        $this->_model=$model;
        /*We extract the field names, if provided*/
        if (!isset($options["fields"])){
            $model_name=$this->_modelName;
            $this->_fields=array_keys($this->_model[0][$model_name]);
        } else {
            $this->_fields=$options["fields"];    
        }
        //$this->_show($this->_fields, "campos");
        
        /* Extract the labels to be used instead of
          the field names. That is, perhaps the user
          decided to show only fields "id" and "username"
          of a model, but he/she want both fields to be shown
          as "User ID" and "Name"*/
        if (!isset($options["labels"])){
            $this->_labels=$this->_fields;
        } else {
            $this->_labels=$options["labels"];
        }
    }
    private function extract_submodels($model_name){
        $models=array();
        $length=sizeof($this->_model);
        for ($i=0; $i<$length; $i++){
            array_push($models, $this->_model[$i][$model_name]);
        }
        return $models;
    }
    private function get_row_element(){
        
    }
    private function getCells(){
        $models=$this->extract_submodels($this->_modelName);
        $cells="";
        $cells.="<thead>";
        $cells.="<tr>";
        foreach ($this->_labels as $label){
            $cells.="<th>$label</th>";            
        }
        $cells.="</tr>";
        $cells.="</thead>";
        $cells.="<tbody>";
        foreach ($models as $row){
            $cells.="<tr>";
            foreach ($this->_fields as $field){
                $cells.="<td>";
                $cells.=$row[$field];
                $cells.="</td>";
            }
            $cells.="</tr>";
        }
        $cells.="</tbody>";
        return $cells;
    }
    private function check_option($options,$option_name){
        if (!isset($options[$option_name])){
            die ("Couldn't find mandatory option $option_name");
        }
        return $options[$option_name];
    }
    private function set_html_elements($options){
        if (isset($options["row_class"])){
        /* Falta por poner clases en las filas, o
          en las filas pares, o en las impares*/
        }
        if (isset($options["table_class"])){
            $classes_array=$options["table_class"];
            $class_attribute="class='";
            foreach($classes_array as $class){
                $class_attribute.=$class." ";
            }
            $class_attribute.="'";
            $this->_table_element="<table $class_attribute>";
        }
        
    }
    public function render($options){
        
        $this->setName(
            $this->check_option($options,"modelname")
        );
        $this->setModel(
            $this->check_option($options, "results"),
            $options
        );
        $this->set_html_elements($options);
        echo $this->_table_element;
        echo $this->getCells();
        echo "</table>";
    }
    
    
}
?>