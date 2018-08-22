<?php  
class database{   
    protected $_conn = "";
    protected $_result = "";  
    public function __construct(){ // Kết nối csdl đầu tiên
        $this->_conn = mysqli_connect('localhost','root','','template_sharing') 
        or die("Can't connect database");
    }
    public function query($sql){
        if($this->_conn){ // nếu đã kết nối csdl
            $this->_result = mysqli_query($this->_conn,$sql); /* Gán kết quả trả về của câu truy
                                                 vấn cho biến $_result */
                                               return $this->_result;
        }                                
    }
    public function num_rows(){
        if($this->_result){ // nếu đã có kết quả trả về từ câu truy vấn
            $rows = mysqli_num_rows($this->_result);
        }else{
            $rows = 0;
        }
        return $rows; // trả về số dòng tìm được
    }
    public function fetch(){
        if($this->_result){ // nếu có kết quả trả về của câu truy vấn
            $data = mysqli_fetch_assoc($this->_result);
        }else{
            $data = array();
        }
        return $data;
    }
    public function fetchAll(){
		$data = array();
        if($this->_result){ // nếu có kết quả trả về của câu truy vấn
            while($db = mysqli_fetch_assoc($this->_result)){
                $data[] = $db; 
            }
        }
        return $data;
    }
}
?>