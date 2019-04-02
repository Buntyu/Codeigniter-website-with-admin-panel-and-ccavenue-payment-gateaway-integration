<?php include("securearea.php"); ?>
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class rating extends Securearea
{
    // default user and post id ,you can change
    public $user_id = 10 ;
    public $post_id = 444444;

    function __construct()
    {
        parent::__construct();

        $this->lang->load('rating/rating');
        $this->load->model('rating_model','rating');
        $this->load->library('form_validation');
    }

    /**
     *  display all ratings in specfic article.
     */
    function index()
    {
        $data["post_id"] = $this->post_id;
        $data["is_rated"] =  $this->rating->get_user_numrate($this->post_id,$this->user_id);

        $total_rates = 0;
        $total_points = 0;
        $query1 = $this->rating->get_article_rate($this->post_id);
        // check if article has rate if yes get it
        if($query1 !== false){
            $total_rates = $query1->rt_total_rates;
            $total_points = $query1->rt_total_points;
        }
        // if rating greater than zero
        // dived total rats on total rates and send it to view
        // else send zero to view
        if($total_points > 0 and $total_rates > 0){
            $ratings = $total_points/$total_rates;
            $data["ratings"] = $total_points/$total_rates;
            $data["rates"] = $ratings;
        }else{
            $data["rates"] = 0;
        }
        $this->load->view('rating_view',$data);
    }

    // create new rate
    function create_rate()
    {
        $this->user_id = 10;

            $post_id= $this->input->post("pid");
            $rate=  $this->input->post("score");

            //check the article is rated already

             $rated = $this->rating->get_rate_numbers($post_id);
            if($rated == 0 ) {
                // if no send new rate record
                $rate_query = $this->rating->insert_rate($post_id,$rate,$this->user_id);
            }else {
                // else get rate id and update value
                $rate_id = $this->rating->get_article_rate($post_id);
                $rate_query =  $this->rating->update_rate($rate_id->rt_id,$rate,$this->user_id);

            }
    /// after this see Succesfull msg
        if($rate_query)
        {
            echo "Voting Succesfull";
        }
    }
}