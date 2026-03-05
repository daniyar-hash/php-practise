<?php


namespace myframew;

class Validator {

    protected $errors = [];
    protected $rules_valid = ['required', 'min', 'max', 'email', 'match', 'unique', 'ext', 'size'];
    protected $data_items;
    protected $error_mess = [

        'required' => ' The :fieldname: must not be empty',
        'min' => ' The :fieldname: must be minimum :rule-val: characters ',
        'max' => '  The :fieldname: must be maximum :rule-val: characters',
        'email' => 'Not valid Email',
        'match' =>' The :fieldname: must be match :rule-val: field',
        'unique' => 'The :fieldname: is already taken',
        'ext' => 'File :fieldname: extension does not match. Allowed  :rule-val:',
        'size' => 'File :fieldname: must be less than :rule-val: bytes',


    ];


    public function validate($data = [], $rules_list = [])
        {

            //  print_arr($data);
            //  dump($rules_list);
           
            $this->data_items = $data;

            foreach($data as $fieldname => $value){
                if(isset($rules_list[$fieldname])){

                        $this->check([
                            'fieldname' => $fieldname,
                            'value' => $value,
                            'rules' =>$rules_list[$fieldname]
                        ]);

       
   
                }
            }

            return $this;
            
        }

        protected function check($field)
        {
                   
         
            foreach($field['rules'] as $rule => $rules_value){

                if(in_array($rule, $this->rules_valid)) {
                 
                    if(!call_user_func_array([$this, $rule], [$field['value'], $rules_value])){

                        $this->addError($field['fieldname'], str_replace([':fieldname:', ':rule-val:'],
                         [$field['fieldname'], $rules_value], 
                         $this->error_mess[$rule]));
                    }
                   
                }

             }

        }

        public function getError()
        {
            return $this->errors;

            
        }

        public function hasError()
        {
            return !empty($this->errors);  
        }


        public function listErrors($fieldname)
        {
            $output = "";
            if(isset($this->errors[$fieldname])){
                $output.= "<div class='invalid-feedback d-block'><ul class='list-unstyled'>";
                foreach($this->errors[$fieldname] as $error) {
                    $output.= "<li>{$error}</li>";
                }
                $output.="</ul></div>";

            }

            return $output;


        }


        protected function addError($fieldname, $error)
        {

            $this->errors[$fieldname][] = $error;

        }


        protected function required($value, $rules_value)
        {
            // dump($value);
            // dump($rules_value);
            return !empty($value);

        }

         protected function min($value, $rules_value)
        {

            return mb_strlen($value, 'UTF-8') >= $rules_value;   // 0 > 5  false
  
        }

          protected function max($value, $rules_value)
        {      
            return mb_strlen($value, 'UTF-8') <= $rules_value;
        }


        protected function email($value, $rules_value)
        {            
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        }

        
        protected function match($value, $rules_value)
        {       
           return $value === $this->data_items[$rules_value];
        
        }

        protected function unique($value, $rules_value)
        {          

            $data = explode(":", $rules_value);
            return  (!db()->query("SELECT {$data[1]} from {$data[0]} WHERE {$data[1]} = ?", [$value])->getColumn());
        }


        protected function ext($value, $rules_value)
        
        {    
       
            if(empty($value['name'])){
                return true;
            }

            $file_ext = get_file_ext($value['name']);

       

              $rules_ext = explode('|', $rules_value);

        
             return in_array($file_ext, $rules_ext);
             
          
        
        }


        protected function size($value, $rules_value)
        
        {    

            if(empty($value['size'])){
                return true;
            }
                // dump($rules_value);
                // dd($value);
             
            return $value['size'] <= $rules_value;

        
        }




}