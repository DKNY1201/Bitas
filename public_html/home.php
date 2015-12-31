<?php
session_start();
$lang="vn";

$lang_arr=array("vn","en","cn");
if (isset($_COOKIE['lang']) == true){ 
	if (in_array($_COOKIE['lang'],$lang_arr)==true) $lang = $_COOKIE['lang'];
}
/*
if (isset($_GET['lang']) == true){
	if (in_array($_GET['lang'], $lang_arr)==true) $lang = $_GET['lang'];
}
elseif (isset($_COOKIE['lang']) == true){ 
	if (in_array($_COOKIE['lang'],$lang_arr)==true) $lang = $_COOKIE['lang'];
}
elseif (isset($_SESSION['lang']) == true){ 
	if (in_array($_SESSION['lang'],$lang_arr) == true) $lang = $_SESSION['lang'];
}
$_SESSION['lang'] = $lang;
setcookie('lang' , $lang , time()+60*60*24*30);
*/
require_once "lang/lang_$lang.php";
ob_start();
include "index.php";
$str=ob_get_clean();
$str = str_replace("{Site_Title}" , Site_Title , $str);
$str = str_replace("{Hotline}" , Hotline , $str);
$str = str_replace("{From}" , From , $str);
$str = str_replace("{Intro_Bitas}" , Intro_Bitas , $str);
$str = str_replace("{Company_Name}" , Company_Name , $str);
$str = str_replace("{Company_Address}" , Company_Address , $str);
$str = str_replace("{Company_Slogan}" , Company_Slogan , $str);
$str = str_replace("{New_Top}" , New_Top , $str);
$str = str_replace("{Same_Type_Product}" , Same_Type_Product , $str);
$str = str_replace("{Customer_Info}" , Customer_Info , $str);
$str = str_replace("{Finish_Cart}" , Finish_Cart , $str);
$str = str_replace("{No_Product_In_Cart}" , No_Product_In_Cart , $str);
$str = str_replace("{Continue_Shopping}" , Continue_Shopping , $str);
$str = str_replace("{Process_Payment}" , Process_Payment , $str);
$str = str_replace("{Description}" , Description , $str);
$str = str_replace("{Quantity}" , Quantity , $str);
$str = str_replace("{Total}" , Total , $str);
$str = str_replace("{Into_Cash}" , Into_Cash , $str);
$str = str_replace("{Shipping_Fee}" , Shipping_Fee , $str);
$str = str_replace("{Total_Cash}" , Total_Cash , $str);
$str = str_replace("{Including_Tax}" , Including_Tax , $str);
$str = str_replace("{Recipient}" , Recipient , $str);
$str = str_replace("{Email_Confirm_Note}" , Email_Confirm_Note , $str);
$str = str_replace("{Same_Address_Shipping}" , Same_Address_Shipping , $str);
$str = str_replace("{Shipping_Address}" , Shipping_Address , $str);
$str = str_replace("{Choose_Province}" , Choose_Province , $str);
$str = str_replace("{Choose_District}" , Choose_District , $str);
$str = str_replace("{Note_Text}" , Note_Text , $str);
$str = str_replace("{Sign_Up_For_Newsletter}" , Sign_Up_For_Newsletter , $str);
$str = str_replace("{Register_Buy}" , Register_Buy , $str);
$str = str_replace("{Already_Customer}" , Already_Customer , $str);
$str = str_replace("{Plz_Login_To_Buy}" , Plz_Login_To_Buy , $str);
$str = str_replace("{Click_If_Forget}" , Click_If_Forget , $str);
$str = str_replace("{First_Time_Shopping}" , First_Time_Shopping , $str);
$str = str_replace("{To_Next_Process}" , To_Next_Process , $str);
$str = str_replace("{Your_Info_Will_Create}" , Your_Info_Will_Create , $str);
$str = str_replace("{Pay_When_Recieve_Note}" , Pay_When_Recieve_Note , $str);
$str = str_replace("{Bank_Transfer_Note}" , Bank_Transfer_Note , $str);
$str = str_replace("{Order_Success}" , Order_Success , $str);
$str = str_replace("{Your_Order_Code}" , Your_Order_Code , $str);
$str = str_replace("{To_Track_Order_Status}" , To_Track_Order_Status , $str);
$str = str_replace("{Your_Order_Info_Send_Email}" , Your_Order_Info_Send_Email , $str);
$str = str_replace("{Because_You_R_Close_Customer}" , Because_You_R_Close_Customer , $str);
$str = str_replace("{Manage_Order}" , Manage_Order , $str);
$str = str_replace("{Search_Result}" , Search_Result , $str);
$str = str_replace("{Cannot_Find}" , Cannot_Find , $str);
$str = str_replace("{Found}" , Found , $str);
$str = str_replace("{Product_With_Keyword}" , Product_With_Keyword , $str);
$str = str_replace("{Intro_Sum}" , Intro_Sum , $str);
$str = str_replace("{Transaction_Fee}" , Transaction_Fee , $str);
//login
$str = str_replace("{Register}" , Register , $str);
$str = str_replace("{Account}" , Account , $str);
$str = str_replace("{Login}" , Login , $str);
$str = str_replace("{Logout}" , Logout , $str);
$str = str_replace("{Password}" , Password , $str);
$str = str_replace("{Keep_Login}" , Keep_Login , $str);
$str = str_replace("{Forget_Pass}" , Forget_Pass , $str);
$str = str_replace("{Error}" , Error , $str);
$str = str_replace("{Wishlist}" , Wishlist , $str);
$str = str_replace("{New_Customer}" , New_Customer , $str);
//search
$str = str_replace("{Language}" , Language , $str);
$str = str_replace("{Vietnamese}" , Vietnamese , $str);
$str = str_replace("{English}" , English , $str);
$str = str_replace("{Chinese}" , Chinese , $str);
$str = str_replace("{Search_Keyword}" , Search_Keyword , $str);
$str = str_replace("{Search}" , Search , $str);
//cart sum
$str = str_replace("{Cart}" , Cart , $str);
$str = str_replace("{non_num_in_cart}" , non_num_in_cart , $str);
$str = str_replace("{See_cart}" , See_cart , $str);
$str = str_replace("{Payment}" , Payment , $str);
$str = str_replace("{Color}" , Color , $str);
$str = str_replace("{Size}" , Size , $str);
$str = str_replace("{Amount}" , Amount , $str);
$str = str_replace("{Price}" , Price , $str);
//menu
$str = str_replace("{Home}" , Home , $str);
$str = str_replace("{Intro}" , Intro , $str);
$str = str_replace("{Shopping}" , Shopping , $str);
$str = str_replace("{Product}" , Product , $str);
$str = str_replace("{Distribution}" , Distribution , $str);
$str = str_replace("{Promotion}" , Promotion , $str);
$str = str_replace("{News}" , News , $str);
$str = str_replace("{Recruitment}" , Recruitment , $str);
$str = str_replace("{Contact}" , Contact , $str);

$str = str_replace("{Product_new}" , Product_new , $str);
$str = str_replace("{Product_saleoff}" , Product_saleoff , $str);
$str = str_replace("{New}" , Newz , $str);

//right module
$str = str_replace("{Member}" , Member , $str);
$str = str_replace("{Hits_counter}" , Hits_counter , $str);
$str = str_replace("{Counter}" , Counter , $str);
$str = str_replace("{Newest_Comment}" , Newest_Comment , $str);
$str = str_replace("{See_more}" , See_more , $str);

//bottom
$str = str_replace("{About_Bita's}" , About_Bitas , $str);
$str = str_replace("{Support}" , Support , $str);
$str = str_replace("{Connect_us}" , Connect_us , $str);
$str = str_replace("{Newsletter}" , Newsletter , $str);
$str = str_replace("{Newsletter_text}" , Newsletter_text , $str);
$str = str_replace("{Contact_us}" , Contact_us , $str);
$str = str_replace("{To_Top}" , To_Top , $str);
$str = str_replace("{About_Us}" , About_Us , $str);

//shopping page
$str = str_replace("{Girl}" , Girl , $str);
$str = str_replace("{Boy}" , Boy , $str);
$str = str_replace("{New_Pro}" , New_Pro , $str);
$str = str_replace("{Discount}" , Discount , $str);
$str = str_replace("{Foot_wear}" , Foot_wear , $str);
$str = str_replace("{Shoes}" , Shoes , $str);
$str = str_replace("{Fashion}" , Fashion , $str);
$str = str_replace("{Fav_product}" , Fav_product , $str);
$str = str_replace("{product}" , product , $str);
$str = str_replace("{Rate}" , Rate , $str);

//distribution page
$str = str_replace("{Brands}" , Brands , $str);
$str = str_replace("{Stores}" , Stores , $str);
$str = str_replace("{Tel}" , Tel , $str);
$str = str_replace("{Chose_district}" , Chose_district , $str);

//promotion page
$str = str_replace("{Promotion_program}" , Promotion_program , $str);
$str = str_replace("{Promotion_product}" , Promotion_product , $str);
$str = str_replace("{Start_date}" , Start_date , $str);
$str = str_replace("{End_date}" , End_date , $str);

//news page
$str = str_replace("{News_social}" , News_social , $str);
$str = str_replace("{News_private}" , News_private , $str);
$str = str_replace("{View}" , View , $str);
$str = str_replace("{Another_acticle}" , Another_acticle , $str);
//recruitment page
$str = str_replace("{Under_construction}" , Under_construction , $str);
//contact page
$str = str_replace("{Name}" , Name , $str);
$str = str_replace("{Company}" , Company , $str);
$str = str_replace("{Address}" , Address , $str);
$str = str_replace("{Content}" , Content , $str);
$str = str_replace("{Send}" , Send , $str);
$str = str_replace("{Local_business}" , Local_business , $str);
$str = str_replace("{Ex_im_business}" , Ex_im_business , $str);
$str = str_replace("{Sale_department}" , Sale_department , $str);
$str = str_replace("{Tech_department}" , Tech_department , $str);
$str = str_replace("{Contact_Text_1}" , Contact_Text_1 , $str);
$str = str_replace("{Contact_Text_2}" , Contact_Text_2 , $str);
$str = str_replace("{Contact_Text_3}" , Contact_Text_3 , $str);
$str = str_replace("{Contact_Text_4}" , Contact_Text_4 , $str);
//Account
$str = str_replace("{My_Account}" , My_Account , $str);
$str = str_replace("{Account_Info}" , Account_Info , $str);
$str = str_replace("{My_Order}" , My_Order , $str);
$str = str_replace("{Hello}" , Hello , $str);
$str = str_replace("{Order_Intro}" , Order_Intro , $str);
$str = str_replace("{Contact_Info}" , Contact_Info , $str);
$str = str_replace("{Change_Pass}" , Change_Pass , $str);
$str = str_replace("{Change_Info}" , Change_Info , $str);
$str = str_replace("{Address_and_Delivery}" , Address_and_Delivery , $str);
$str = str_replace("{Change}" , Change , $str);
$str = str_replace("{Change_Account}" , Change_Account , $str);
$str = str_replace("{Email}" , Email , $str);
$str = str_replace("{Sex}" , Sex , $str);
$str = str_replace("{Women}" , Women , $str);
$str = str_replace("{Men}" , Men , $str);
$str = str_replace("{Fullname}" , Fullname , $str);
$str = str_replace("{Birthday}" , Birthday, $str);
$str = str_replace("{Required_Field}" , Required_Field, $str);
$str = str_replace("{Info_Change}" , Info_Change , $str);
$str = str_replace("{Old_Pass}" , Old_Pass , $str);
$str = str_replace("{New_Pass}" , New_Pass, $str);
$str = str_replace("{Renew_Pass}" , Renew_Pass, $str);
$str = str_replace("{Re_Enter_Pass}" , Re_Enter_Pass, $str);
$str = str_replace("{Order}" , Order , $str);
$str = str_replace("{Date}" , Date , $str);
$str = str_replace("{Delivery_Address}" , Delivery_Address , $str);
$str = str_replace("{Order_Value}" , Order_Value, $str);
$str = str_replace("{Detail}" , Detail, $str);
$str = str_replace("{Order_Detail}" , Order_Detail, $str);
$str = str_replace("{Info_Delivery}" , Info_Delivery , $str);
$str = str_replace("{Howtopay}" , Howtopay , $str);
$str = str_replace("{Product_Name}" , Product_Name , $str);
$str = str_replace("{Cash}" , Cash , $str);
$str = str_replace("{Bank_Transfer}" , Bank_Transfer , $str);
$str = str_replace("{Pay_When_Recieve}" , Pay_When_Recieve , $str);
$str = str_replace("{Email_Confirm_Text}" , Email_Confirm_Text, $str);
$str = str_replace("{Pass}" , Pass , $str);
$str = str_replace("{Repass}" , Repass , $str);
$str = str_replace("{Additional_Info}" , Additional_Info , $str);
$str = str_replace("{To_Confirm_Order}" , To_Confirm_Order , $str);
$str = str_replace("{To_Delivery}" , To_Delivery , $str);
$str = str_replace("{Get_News_Via_Email}" , Get_News_Via_Email , $str);
$str = str_replace("{Province}" , Province , $str);
$str = str_replace("{District}" , District , $str);
$str = str_replace("{My_Wishlist}" , My_Wishlist , $str);
$str = str_replace("{Add_To_Cart}" , Add_To_Cart , $str);
$str = str_replace("{No_Product_Wishlist}" , No_Product_Wishlist , $str);
$str = str_replace("{Del_Pro}" , Del_Pro , $str);
//Detail Product
$str = str_replace("{Choose_size}" , Choose_size , $str);
$str = str_replace("{Choose_color}" , Choose_color , $str);
$str = str_replace("{Customer_comment}" , Customer_comment , $str);
$str = str_replace("{We_want_to_know_your_comment}" , We_want_to_know_your_comment , $str);
$str = str_replace("{Will_be_sec}" , Will_be_sec , $str);
$str = str_replace("{Comment}" , Comment , $str);
$str = str_replace("{Send_Comment}" , Send_Comment , $str);
$str = str_replace("{Plz_comment}" , Plz_comment , $str);
$str = str_replace("{Will_be_sec}" , Will_be_sec , $str);
$str = str_replace("{Buy_good}" , Buy_good , $str);
$str = str_replace("{Will_be_at_ur_house}" , Will_be_at_ur_house , $str);
$str = str_replace("{In_n_day}" , In_n_day , $str);
$str = str_replace("{Pay_when_recieve}" , Pay_when_recieve , $str);
$str = str_replace("{Return_in_n_day}" , Return_in_n_day , $str);
$str = str_replace("{Return_cash}" , Return_cash , $str);
$str = str_replace("{Maybe_you_like}" , Maybe_you_like , $str);
$str = str_replace("{Tks_for_comment}" , Tks_for_comment , $str);

//Footer
$str = str_replace("{Shopping_Guide}" , Shopping_Guide , $str);
$str = str_replace("{Online_Support}" , Online_Support , $str);
$str = str_replace("{Term}" , Term , $str);
$str = str_replace("{Condition}" , Condition , $str);
$str = str_replace("{Outstanding_Service}" , Outstanding_Service , $str);
$str = str_replace("{Journalism}" , Journalism , $str);
$str = str_replace("{Privacy_Policy}" , Privacy_Policy , $str);
$str = str_replace("{Communication}" , Communication , $str);

$str = str_replace("{FAQ}" , FAQ , $str);
$str = str_replace("{Return_Guide}" , Return_Guide , $str);
$str = str_replace("{Choose_Size_Guide}" , Choose_Size_Guide , $str);
$str = str_replace("{Deliver_Policy}" , Deliver_Policy , $str);
$str = str_replace("{Get_Reimbursed_At_Place}" , Get_Reimbursed_At_Place , $str);
$str = str_replace("{Send_Feedback}" , Send_Feedback , $str);
$str = str_replace("{Your_Email}" , Your_Email , $str);
//
$str = str_replace("{Note}" , Note , $str);
$str = str_replace("{Free_Return}" , Free_Return , $str);
$str = str_replace("{Free_Warranty}" , Free_Warranty , $str);
$str = str_replace("{Pay_When_Recieve_Rule}" , Pay_When_Recieve_Rule , $str);
$str = str_replace("{Free_Return_Rule}" , Free_Return_Rule , $str);
$str = str_replace("{Free_Warranty_Rule}" , Free_Warranty_Rule , $str);
$str = str_replace("{Pay_Flexible}" , Pay_Flexible , $str);
$str = str_replace("{Status}" , Status , $str);
$str = str_replace("{Order_History}" , Order_History , $str);
$str = str_replace("{Return_Warranty_Location}" , Return_Warranty_Location , $str);
$str = str_replace("{Ward}" , Ward , $str);
$str = str_replace("{Choose_Ward}" , Choose_Ward , $str);
echo $str;
?>