<?php


function displayError($errors, $input){

      if($_POST){

         if(!empty($errors[$input])){
            echo '<p class="red_alert">'.$errors[$input].'</p>';
         }
      }
   }

   ?>