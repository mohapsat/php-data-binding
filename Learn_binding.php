<?php

error_reporting(E_ALL); //set to 0 in prod

require '/connect.php';

/*
//SELECT--- > Start

  if($result = $db->query("SELECT * FROM PEOPLE")) {

      if($result->num_rows) {//result has more than 0 rows
        // echo $result->num_rows;
        // $rows = $result->fetch_assoc();
          //converts results object to rows associative Array, should be used inside a loop or use fetch_all instead
        // $rows = $result->fetch_all(MYSQLI_ASSOC);
          //fetch all take a param to return an assoc array, usually a waste of resource to fetch all data, instead use loop
        //echo '<pre>', print_r($rows), '</pre>';
          //preformatted tags, pretty print the array

                while ($row = $result->fetch_object()) {
                  echo $row->first_name, ' ', $row->last_name, '<br>';
                } //end while - use fetch_object instead of fetch_assoc and user object notation instead of [] to pick attributes

                $result->free(); //free memory used to store result
            } //end innner if
          } else {
    die($db->error); // or silently kill the page or redirect to somewhere
  } //end else

//SELECT--- > end
*/

/*
//UPDATE--- > Start

if($update = $db->query("UPDATE people set created=now()")) {

  echo $db->affected_rows;

}

//UPDATE--- > end
*/

/*
// get values as variables and real escape em

if( isset($_GET['first_name'])){//check if first name isset

    echo  $first_name = $db->real_escape_string(trim($_GET['first_name'])); //trim it

    if($insert = $db->query("INSERT into PEOPLE (first_name, last_name, bio, created) values ('{$first_name}','Cook','I am a cook',now())")){
      echo $db ->affected_rows;
    }

}

*/

//binding variables to query

// match all records from database that match last name using bind

  if(isset($_GET['last_name'], $_GET['id'])) {

      $last_name = trim($_GET['last_name']);
      $id = trim($_GET['id']);
      // $last_name = trim($_GET['first_name']);

      $people = $db->prepare("SELECT id, first_name, last_name, bio FROM PEOPLE WHERE last_name = ? and id = ?"); //when we prepare a statement we dont execute it until we call the execute on it. ? point sto bound variables
      $people->bind_param('si',$last_name,$id); //we've bound a string value to last name on first pos
      $people->execute();

      // print_r($people);

      $people->bind_result($id, $first_name, $last_name, $bio); //bound values of data being returned corresponding to the postion of the data being returned in bind_param

      //  print_r($people);



      while($people->fetch()){
        echo $id,' ',$first_name, ' ',$last_name, ' ',$bio,'<br>';
      } //need to fetch results and loop over results


  }




?>
