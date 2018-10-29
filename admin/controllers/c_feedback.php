<?php
session_start();
class C_feedback
{

	 function __construct() {
        if(!isset($_SESSION["user"])) {
            echo "<script>window.location='.'</script>";
        } 
    }

    public function show_all() {
    	//models
    	include("models/m_feedback.php");
    	include("models/m_users.php");
    	$m_user = new M_users();
    	$m_fb = new M_feedback();
    	$contacts = $m_fb->read_all_feedback();



    	//views 
    	$view = "views/feedback/v_list.php";
    	$title = " List of Feedback";
    	include("include/layout.php");
    }
	
}