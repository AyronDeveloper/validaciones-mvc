<?php
class Vali{
    private $name="";
    private $variable;
    private $result;
    private $message;


    private function analisis($analisis){
        $analisis=trim($analisis);
        if($analisis==null || $analisis==""){
            return true;
        }else{
            return false;
        }
    }


    //REQUIRED VALIDA SI UN CAMPO ESTA VACIO
    public function required($name,$value,$error=null,$message=null){

        $this->name="";
        $this->variable="";
        $this->result="";
        $this->message="";

        $value=trim($value);
        if(!empty($value)){
            $this->result=true;
            $this->variable=$value;
            $this->message=$this->analisis($message)?"validated":$message;
            $this->name=$name;

        }else{
            $this->result=false;
            $this->message=$this->analisis($error)?"vacio Error":$error;
            $this->name=$name;
            
        }

        $_SESSION["formValidation"][$this->name]=$this->variable;
        $_SESSION["formValidation"][$this->name."Result"]=$this->result;
        $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        return $this;
    }

    //isNumber
    public function isNumber($error=null,$message=null){
        if($this->result==true){
            if(is_numeric($this->variable)){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;
                
            }else{
                $this->variable="";
                $this->message=$this->analisis($error)?"esNumero Error":$error;
                $this->result=false;
                
            }

            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    //isInteger
    public function isInteger($error=null,$message=null){
        if($this->result==true){
            if(false === strpos($this->variable,".")){
                $entero=intval($this->variable);
                if(is_int($entero)){
                    $this->result=true;
                    $this->message=$this->analisis($message)?"validated":$message;
                    
                }else{
                    $this->variable="";
                    $this->message=$this->analisis($error)?"esEntero Error":$error;
                    $this->result=false;
                    
                }
            }else{
                $this->variable="";
                $this->message=$this->analisis($error)?"esEntero Error":$error;
                $this->result=false;
            
            }

            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    //isFloat
    public function isFloat($error=null,$message=null){
        if($this->result==true){
            if(false !== strpos($this->variable,".")){
                $double=doubleval($this->variable);
                if(is_double($double)){
                    $this->result=true;
                    $this->message=$this->analisis($message)?"validated":$message;
                }else{
                    $this->variable="";
                    $this->message=$this->analisis($error)?"esDecimal Error":$error;
                    $this->result=false;
                }
            }else{
                $this->variable="";
                $this->message=$this->analisis($error)?"esDecimal Error":$error;
                $this->result=false;
            }

            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }
    
    //isString
    public function isString($only=null,$error=null,$message=null){
        if($this->result==true){
            if(is_string($this->variable)){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;

            }else{
                $this->variable="";
                $this->message=$this->analisis($error)?"esCadena Error":$error;
                $this->result=false;
                
            }
            
            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    //equalTo
    public function equalTo($optional,$error=null,$message=null){
        if($this->result==true){
            if($this->variable==$optional){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;
                
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"igualA Error":$error;
                
            }
            
            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    //differentTo
    public function differentTo($optional,$error=null,$message=null){
        if($this->result==true){
            if($this->variable!=$optional){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"diferenteA Error":$error;
            }
            
            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    //isEmail
    public function isEmail($error=null,$message=null){
        if($this->result==true){
            //strpos($this->variable,"@") && strpos($this->variable,".")
            if(filter_var($this->variable, FILTER_VALIDATE_EMAIL)){
            //if(false !== strpos($this->variable,"@") && false !== strpos($this->variable,".")){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"esEmail Error":$error;
            }
            
            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    //lenMax
    public function lenMax($lon,$error=null,$message=null){
        if($this->result==true){
            if(strlen($this->variable)==$lon || strlen($this->variable)<=$lon){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"longitudMax Error":$error;
            }
            
            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }
    
    //lenMin
    public function lenMin($lon,$error=null,$message=null){
        if($this->result==true){
            if(strlen($this->variable)==$lon || strlen($this->variable)>=$lon){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"longitudMin Error":$error;
            }
            
            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    public function isColor($error=null, $message=null){
        if($this->result==true){
            
            function validateColor($color){
                $hexColor="/^#[0-9A-Fa-f]{6}$/";

                if(preg_match($hexColor,$color)){
                    return true;
                }else{
                    return false;
                }
            }

            if(validateColor($this->variable)){
                $this->result=true;
                $this->message=$this->analisis($message)?"validate":$message;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"isColor error":$error;
            }
            
            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    public function validateDate($error=null,$message=null){
        if($this->result==true){

            function dateVerify($fecha){
                $resultDate=false;

                $formatDate="/^\d{4}-\d{2}-\d{2}$/";

                if(preg_match($formatDate,$fecha)){
                    $dateArray=explode("-",$fecha);
        
                    $anio=intval($dateArray[0]);
                    $mes=intval($dateArray[1]);
                    $dia=intval($dateArray[2]);

                    if(checkdate($mes, $dia, $anio)){
                        $resultDate=true;
                    }
                }

                return $resultDate;
            }

            if(dateVerify($this->variable)){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"validateDate Error":$error;
            }
            
            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }


    public function uploadFile($name, $arrayFile, $error=null, $message=null){
        $this->name="";
        $this->variable="";
        $this->result="";
        $this->message="";

        
        $this->name=$name;

        if($arrayFile["error"]==0){
            $this->result=true;
            $this->variable=$arrayFile;
            $this->message=$this->analisis($message)?"validated":$message;
        }else{
            $this->result=false;
            $this->message=$this->analisis($error)?"uploadFile Error":$error;
        }
            
        $_SESSION["formValidation"][$this->name]=$this->variable;
        $_SESSION["formValidation"][$this->name."Result"]=$this->result;
        $_SESSION["formValidation"][$this->name."Men"]=$this->message;

        return $this;

    }

    public function sizeFile($limit, $size, $UA,$error=null, $message=null){
        if($this->result==true){
            $sizeResult=false;

            $byte=1024;

            if($UA=="KB"){
                $sizeFile=$this->variable["size"]/$byte;
            }elseif($UA=="byte"){
                $sizeFile=$this->variable["size"];
            }else{
                $this->result=false;
                $this->message="Error UA";
                
                
                $_SESSION["formValidation"][$this->name]="";
                $_SESSION["formValidation"][$this->name."Result"]=$this->result;
                $_SESSION["formValidation"][$this->name."Men"]=$this->message;
                
                return $this;
            }


            if($limit=="min"){
                if($size<=$sizeFile){
                    $sizeResult=true;
                }
            }elseif($limit=="max"){
                if($size>=$sizeFile){
                    $sizeResult=true;
                }
            }


            if($sizeResult){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"sizeFile Error":$error;
            }
                
            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    public function typeFile($mime, $error=null, $message=null){
        if($this->result==true){
            $typeResult=false;

            if(in_array($this->variable["type"],$mime)){
                $typeResult=true;
            }

            if($typeResult){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"typeFile Error":$error;
            }
                
            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    //isBoolean
    public function isBoolean($name, $bool,$error=null,$message=null){
        $this->name="";
        $this->variable="";
        $this->result="";
        $this->message="";
        

        $this->name=$name;
        if($bool=="true" || $bool=="false" || $bool=="1" || $bool=="0"){
            //$boolval=boolval($bool);
            $boolval=filter_var($bool, FILTER_VALIDATE_BOOLEAN);//PHP 5
            //if(is_bool($boolval)){
            if($boolval!==null){//PHP 5
                if($boolval){
                    $this->result=true;
                    $this->variable=$boolval;
                    $this->message=$this->analisis($message)?"validated TRUE":$message;
        
                }else{
                    $this->result=false;
                    $this->variable=$boolval;
                    $this->message=$this->analisis($error)?"validated FALSE":$error;
                    $this->name=$name;
        
                }
            }else{
                $this->result=false;
                $this->message="esBoolean Error";
                
            }
            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }else{
            $this->result=false;
            $this->message="Booleanos no reconocidos";

            $_SESSION["formValidation"][$this->name]=$this->variable;
            $_SESSION["formValidation"][$this->name."Result"]=$this->result;
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    //isArray
    public function isArray($name, $array, $error=null, $message=null){
        $this->name="";
        $this->variable="";
        $this->result="";
        $this->message="";

        if(is_array($array)){
            $this->result=true;
            $this->variable=$array;
            $this->message=$this->analisis($message)?"validated":$message;
            $this->name=$name;

        }else{
            $this->result=false;
            $this->variable="";
            $this->message=$this->analisis($error)?"esArray error":$error;
            $this->name=$name;

        }

        $_SESSION["formValidation"][$this->name]=$this->variable;
        $_SESSION["formValidation"][$this->name."Result"]=$this->result;
        $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        return $this;
    }


    //create
    public static function create($name,$valor,$message=null){
        $_SESSION["formValidation"][$name]=$valor;
        if($message!=null){
            $_SESSION["formValidation"][$name."Men"]=$message;
        }
    }



    public function results($value=null){
        if($value=="value"){
            return $this->variable;
        }else{
            return array("variable"=>$this->variable,"result"=>$this->result,"message"=>$this->message);
        }
    }


    //clear
    public static function clear(){
        unset($_SESSION["formValidation"]);
    }
    //clearSelect
    public static function clearSelect($name){
        unset($_SESSION["formValidation"][$name]);
        unset($_SESSION["formValidation"][$name."Men"]);
        unset($_SESSION["formValidation"][$name."Result"]);
    }
    //clearExcep
    public static function clearExcep($name){
        foreach($_SESSION["formValidation"] as $session=>$valor){
            if($session!==$name){
                unset($_SESSION["formValidation"][$session]);
                unset($_SESSION["formValidation"][$session."Men"]);
                unset($_SESSION["formValidation"][$name."Result"]);
            }
        }
    }

    public static function success($name){
        if(isset($_SESSION["formValidation"][$name]) && $_SESSION["formValidation"][$name."Result"]==true){
            return true;
        }
    }
    //value
    public static function value($name,$aditional=null){
        if(isset($_SESSION["formValidation"][$name]) && $_SESSION["formValidation"][$name]!=""){
            return $_SESSION["formValidation"][$name];
        }

        if(!empty($aditional)){
            return $aditional;
        }

    }

    public static function valueArray($name,$indice){
        if(isset($_SESSION["formValidation"][$name]) && $_SESSION["formValidation"][$name]!=false){
            return $_SESSION["formValidation"][$name][$indice];
        }
    }
    
    public static function failed($name){
        if(isset($_SESSION["formValidation"][$name]) && $_SESSION["formValidation"][$name."Result"]==false){
            return true;
        }
    }

    public static function showMessage($name){
        if(isset($_SESSION["formValidation"][$name])){
            return $_SESSION["formValidation"][$name."Men"];
        }
    }

}
?>
