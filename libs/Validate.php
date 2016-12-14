<?php
class Validate{
	
	// Error array
	private $errors	= array();
	
	// Source array
	private $source	= array();
	
	// Rules array
	private $rules	= array();
	
	// Result array
	private $result	= array();
	
	// Contrucst
	public function __construct($source){
		$this->source = $source;
	}
	
	// Add rules
	public function addRules($rules){
		$this->rules = array_merge($rules, $this->rules );
	}
	
	// Get error
	public function getError(){
		return $this->errors;
	}
	
	// Set error
	public function setError($element, $message){
		$strElement = str_replace('_', ' ', $element);
		if(array_key_exists($element, $this->errors)){
			$this->errors[$element] .= ' - ' . $message;
		}else{
			$this->errors[$element] = '<b>' . ucwords($strElement) . ':</b> ' . $message;
		}
	}
	
	// Get result
	public function getResult(){
		return $this->result;
	}
	
	// Add rule
	public function addRule($element, $type, $options = null, $required = true){
		$this->rules[$element] = array('type' => $type, 'options' => $options, 'required' => $required);
		return $this;
	}
	
	// Run
	public function run(){
		foreach($this->rules as $element => $value){
			if($value['required'] == true && trim($this->source[$element])==null){
				$this->setError($element, 'không được để trống!');
			}else{
				switch ($value['type']) {
					case 'int':
						$this->validateInt($element, $value['options']['min'], $value['options']['max']);
						break;
					case 'string':
						$this->validateString($element, $value['options']['min'], $value['options']['max']);
						break;
                    case 'stringSamePassword':
                        $this->validateString($element, $value['options']['min'], $value['options']['max']);
                        $this->validateSamePassword($element, $value['options']['password']);
                        break;
					case 'url':
						$this->validateUrl($element);
						break;
					case 'email':
						$this->validateEmail($element);
						break;
					case 'status':
						$this->validateStatus($element, $value['options']);
						break;
					case 'group':
						$this->validateGroupID($element);
						break;
					case 'password':
						$this->validatePassword($element, $value['options']);
						break;
					case 'date':
						$this->validateDate($element, $value['options']['start'], $value['options']['end']);
						break;
					case 'existRecord':
						$this->validateExistRecord($element, $value['options']);
						break;
                    case 'notExistRecord':
                        $this->validateNotExistRecord($element, $value['options']);
                        break;
                    case 'stringNotExistRecord':
                        $this->validateString($element, $value['options']['min'], $value['options']['max']);
                        $this->validateNotExistRecord($element, $value['options']);
                        break;
                    case 'emailNotExistRecord':
                        $this->validateEmail($element);
                        $this->validateNotExistRecord($element, $value['options']);
                        break;
					case 'file':
						$this->validateFile($element, $value['options']);
						break;
				}
			}
			if(!array_key_exists($element, $this->errors)) {
				$this->result[$element] = $this->source[$element];
			}
		}
		$eleNotValidate = array_diff_key($this->source, $this->errors);
		$this->result	= array_merge($this->result, $eleNotValidate);
		
	}
	
	// Validate Integer
	private function validateInt($element, $min = 0, $max = 0){
		if(!filter_var($this->source[$element], FILTER_VALIDATE_INT, array("options"=>array("min_range"=>$min,"max_range"=>$max)))){
			$this->setError($element, 'vui lòng nhập số');
		}
	}
	
	// Validate String
	private function validateString($element, $min = 0, $max = 0){
		$length = strlen($this->source[$element]);
		if($length < $min) {
			$this->setError($element, 'độ dài quá ngắn');
		}else if($length > $max){
			$this->setError($element, 'độ dài quá dài');
		}else if(!is_string($this->source[$element])){
			$this->setError($element, 'vui lòng nhập ký tự hợp lệ');
		}
	}
	
	// Validate URL
	private function validateURL($element){
		if(!filter_var($this->source[$element], FILTER_VALIDATE_URL)){
			$this->setError($element, 'là một đường dẫn không hợp lệ');
		}
	}
	
	// Validate Email
	private function validateEmail($element){
		if(!filter_var($this->source[$element], FILTER_VALIDATE_EMAIL)){
			$this->setError($element, 'là một email không hợp lệ');
		}
	}
	
	public function isValid(){
	 	if(count($this->errors)>0) return false;
	 	return true;	
	}
	
	// Validate Status
	private function validateStatus($element, $options){
		if(in_array($this->source[$element], $options['deny']) == true){
			$this->setError($element, 'vui lòng chọn giá trị khác giá trị mặc định!');
		}
	}
	
	// Validate GroupID
	private function validateGroupID($element){
		if($this->source[$element] == 0){
			$this->setError($element, 'Select group');
		}
	}
	
	// Validate Password
	private function validatePassword($element, $options){		
		if(($options['action'] == 'add' || $options['action'] == 'register' ||  ($options['action'] == 'edit' ) && $this->source[$element] ) ){
			$pattern = '#^(?=.*\d)(?=.*[A-Z])(?=.*\W).{8,8}$#';
			if(!preg_match($pattern, $this->source[$element])){
				$this->setError($element, 'không hợp lệ!');
			};
		}
	}

    // Validate RePassword
    private function validateSamePassword($element, $options){
        if(trim($this->source[$element]) != $options){
            $this->setError($element, 'Vui lòng nhập giống password!');
        }
    }
	
	// Validate Date
	private function validateDate($element, $start, $end){		
		// Start
		$arrDateStart 	= date_parse_from_format('d/m/Y', $start) ;
		$tsStart		= mktime(0, 0, 0, $arrDateStart['month'], $arrDateStart['day'], $arrDateStart['year']);
			
		// End
		$arrDateEnd 	= date_parse_from_format('d/m/Y', $end) ;
		$tsEnd			= mktime(0, 0, 0, $arrDateEnd['month'], $arrDateEnd['day'], $arrDateEnd['year']);
		
		// Current
		$arrDateCurrent	= date_parse_from_format('d/m/Y', $this->source[$element]) ;
		$tsCurrent		= mktime(0, 0, 0, $arrDateCurrent['month'], $arrDateCurrent['day'], $arrDateCurrent['year']);
		
		if($tsCurrent < $tsStart || $tsCurrent > $tsEnd){
			$this->setError($element, 'is an invalid date');
		}
	}
	
	// Validate Exist record
	private function validateExistRecord($element, $options){
		$database = $options['database'];
		$query	  = $options['query'];
		if($database->isExist($query)==false){
			$this->setError($element, 'chưa tồn tại');
		}
	}

    // Validate Not Exist record
    private function validateNotExistRecord($element, $options){
        $database = $options['database'];
        $query	  = $options['query'];
        if(!$database->isExist($query)==false){
            $this->setError($element, 'đã tồn tại');
        }
    }
	
	// Validate File
	private function validateFile($element, $options){

		if(!filter_var($this->source[$element]['size'], FILTER_VALIDATE_INT, array("options"=>array("min_range"=>$options['min'],"max_range"=>$options['max'])))){
			$this->setError($element, 'kích thước không phù hợp');
		}
		
		$ext = pathinfo($this->source[$element]['name'], PATHINFO_EXTENSION);
		if(in_array($ext, $options['entension']) == false){
			$this->setError($element, 'phần mở rộng không phù hợp');
		}
	}

	public function showErrors(){
        $xhtml = "";
        if(!empty($this->errors)){
            $xhtml .= "<div class='error-info'>";
            $xhtml .= '<h4><i class="fa fa-warning"></i> Lỗi !</h4>';
            $xhtml .= "<ul>";
            foreach ($this->errors as $key => $value){
                $xhtml .= "<li>".$value."</li>";
            }
            $xhtml .= "</ul></div>";
        }
        return $xhtml;
    }

}










