<?php
  error_reporting(E_ALL);
  require '/connect.php';
  require '/security.php';

  $records = array(); //setup a records array

  // fetch table data

    if($results = $db->query("SELECT * FROM people")) { //pass all results into a results object
      if($results->num_rows){ //check if rows reruned is not 0
        while($row = $results->fetch_object()){ //loop over results and fetch objects
          $records[] = $row; //appeand records array with row values
        }
        $results->free(); //free mem from restults object
      }
    }




// insert data into records array

  if(!empty($_POST))  { //check if post is non empty
    if(isset($_POST['first_name'], $_POST['last_name'], $_POST['bio'])) { //if each post value is non empty

      $first_name = trim($_POST['first_name']); //trim for white spaces and assign to vars
      $last_name  = trim($_POST['last_name']);
      $bio        = trim($_POST['bio']);

      if(!empty($first_name) && !empty($last_name) && !empty($bio)){ //check for non empty vals
        //get ready for binding

        // prepare
        $insert = $db->prepare("INSERT INTO people (first_name, last_name, bio, created) values (?,?,?,NOW())");// bind params
        $insert->bind_param('sss',$first_name, $last_name, $bio);// bind results

        // $delete = $db->prepare("DELETE FROM PEOPLE WHERE first_name like '%?%'");
        // $delete->bind_params('s',$first_name);
        // $delete->execute();

        if($insert->execute()){ //executing and checking
          header('Location: index.php');//redirect to index.php
          die();
        }
      }
    }
  }

// $ar = json_encode($records);

// echo '<pre>', print_r($ar) ,'</pre>';

?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>People App</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">
      <h3 class="text-info">People's Table</h3>
      <div class="row">
        <div class="col-sm-10">
          <!-- markup for table to be displayed -->

          <?php
          if(!count($records)){
              echo 'No records found';
            } else {
            ?>
              <table id="id-datatable" class="table table-hover table-bordered table-responsive">
                <thead>
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Bio</th>
                    <th>Created</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                    <?php
                      foreach ($records as $r) {
                      ?>
                  <tr>
                    <td><?php echo escape($r->first_name); ?></td>
                    <td><?php echo escape($r->last_name); ?></td>
                    <td><?php echo escape($r->bio); ?></td>
                    <td><?php echo escape($r->created); ?></td>
                    <td>
                          <div class="hidden-sm hidden-xs action-buttons">
                            <a class="text-default" href="#">
                              <i class="fa fa-search-plus bigger-130"></i>
                            </a>

                            <a class="text-success" href="#">
                              <i class="fa fa-pencil bigger-130"></i>
                            </a>

                            <a class="text-danger" href="#">
                              <i class="fa fa-trash-o bigger-130"></i>
                            </a>
                          </div>
                    </td>
                  </tr>
                    <?php
                      } //end foreach
                    ?>
                </tbody>

              </table>
              <?php
            }//end else
              ?>
              <div class="alert alert-success" hidden="true">
                Record inserted successfully!
              </div>
        </div>
      </div>
    <hr>
      <div class="row">
        <div class="col-sm-3">
          <form class="form" action="" method="post"> <!--php fetches post values using name attribute-->
            <div class="form-group">
              <label for="first_name">First Name</label>
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="e.g. John">
            </div>
            <div class="form-group">
              <label for="last_name">Last Name</label>
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="e.g. Doe">
            </div>
            <div class="form-group">
              <label for="bio">Bio</label>
              <textarea type="text" class="form-control" id="bio" name="bio" placeholder="e.g. I love bootstrap"></textarea>
            </div>
            <div class="form-group">
              <input type="button" class="btn btn-success" value="Insert" id="btn-insert"></button>
            </div>
          </form>
        </div>
      </div>
    </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="/phpmysqli/ajax.js"></script>
    <link href="https://code.jquery.com/ui/jquery-ui-git.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-git.js"></script>
    <script src="https://code.jquery.com/ui/jquery-ui-git.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>


    </script>
  </body>
</html>
