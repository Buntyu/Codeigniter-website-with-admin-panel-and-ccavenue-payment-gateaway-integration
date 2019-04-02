<?php include("securearea.php"); ?>
<?php

class Blog extends Securearea
{
    function __construct() {
        parent::__construct();
        $this->load->model('admin/blogs_model');
    }
    
    public function index() 
    {
    $this->loadHeader($this,FALSE,"Blog");
    
   // $this->loadSidebar($this);
    
    $data['blogs_data'] = $this->blogs_model->getAllData();
    
    $this->load->view("blogs_grid_view",$data);
    
    $this->loadFooter($this);
    }

public function viewBlog($prod_name = "",$second = "",$prod_id = "")
    {

        if(is_numeric($second))
        {
            $this->$prod_name($second);die;
        }
        
        $this->productname = removehyphens(urldecode($prod_name));
        
        $this->product = $this->blogs_model->getProduct("","","AND blog_name = '".$this->productname."'");
        //echo "<pre>";print_r($this->product);die;
        if($this->product)
        {
            
            $this->product = $this->product[0];                
          //echo "<pre>";print_r($this->product);die;
            
            //load header
            $this->loadHeader($this,"",removehyphens($prod_name));
            
            //load middle content         
            $view["obj"] = $this;
            $view['userdata'] = $this->userData;
            
            $this->load->view('single_blog_view',$view);     
            
            //load footer
            $this->loadFooter($this);       
        }
        else
        {
            redirect(base_url(),"refresh");
        }           
    }

}
?>