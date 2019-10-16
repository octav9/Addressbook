<?php
function connect(){
    /* 
    No matter what error mode you set, 
    an error connecting will always produce an exception, 
    and creating a connection should always 
    be contained in a try/catch block.
    */
    try {
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=localhost;dbname=addressbook", "root", "");
        return $DBH;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
function getContacts(){
    #This fetch type creates an object of std class for each row of fetched data. 
    # creating the statement
    if(connect()) $DBH=connect();
    $STH = $DBH->query('SELECT id, first_name, last_name, phone, email from contacts');
     
    # setting the fetch mode
    $STH->setFetchMode(PDO::FETCH_OBJ);
     
    // # showing the results
    // while($row = $STH->fetch()) {
    //     echo $row->first_name . "\n";
    //     echo $row->last_name . "\n";
    //     echo $row->phone . "\n";
    //     echo $row->email . "\n";
    // }

    return $STH->fetchAll();
}
function editContact(){
    if(connect()) $DBH=connect();
    $STH = $DBH->prepare("SELECT first_name, last_name, phone, email FROM contacts WHERE id=".$_POST['btnedit']);
    $STH->setFetchMode(PDO::FETCH_OBJ);
    $STH->execute();
    $row = $STH->fetch();
    echo '
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <form action="edit_contact.php" method="post">
                    <div class="field">
                        <label class="label">First Name</label>
                        <div class="control">
                            <input name="first_name" class="input" type="text" placeholder="e.g Alex" required="required" value="'.$row->first_name.'">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Last Name</label>
                        <div class="control">
                            <input name="last_name" class="input" type="text" placeholder="e.g Smith" value="'.$row->last_name.'">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Phone</label>
                        <div class="control">
                            <input name="phone" class="input" type="text" placeholder="e.g. 0744XXXXXX" value="'.$row->phone.'">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input name="email" class="input" type="email" placeholder="e.g. alexsmith@gmail.com" value="'.$row->email.'">
                        </div>
                    </div>

                    <div class="control has-text-right">
                        <button name="submit" class="button is-primary">Submit</button>
                    </div>

                    <input name="id" class="input" type="hidden" value="'.$_POST['btnedit'].'">
                </form>
            </div>
        </div>
        <button class="modal-close is-large" aria-label="close" onclick="toggleModal()"></button>
    </div>
    ';
}
function deleteContact(){
    if(connect()) $DBH=connect();
    $STH = $DBH->prepare("delete FROM contacts WHERE id=".$_POST['btndelete']);
    $STH->execute();
}
if(isset($_POST['btndelete']))
{
    deleteContact();
}
else if(isset($_POST['btnedit']))
{
    editContact();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bulma.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" src="app.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <title>Address Book</title>
</head>
<body>
    <div class="container is-clipped">
        <div class="columns">
            <div class="column">
                <h1 class="title">Address Book</h1>
            </div>
            <div class="column">
                <a class="button is-pulled-right is-primary" onclick="toggleModal()">Add Contact</a>
            </div>
        </div>

        
        <form action="" method="post">
            <table class="table is-fullwidth is-hoverable" id="myTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="has-text-centered">Phone</th>
                    <th class="has-text-centered">Email</th>
                    <th class="has-text-centered">Actions</th>
                </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th class="has-text-centered">Phone</th>
                        <th class="has-text-centered">Email</th>
                        <th class="has-text-centered">Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach(getContacts() as $contact)
                    {
                        echo '
                                <tr>
                                    <th>'.$contact->first_name." ".$contact->last_name.'</th>
                                    <td class="has-text-centered">'.$contact->phone.'</td>
                                    <td class="has-text-centered">'.$contact->email.'</td>
                                    <td class="has-text-centered">
                                        <button class="button is-link" name="btnedit" value="'.$contact->id.'" type="submit">Edit</button>
                                        <button class="button is-danger" name="btndelete" value="'.$contact->id.'" type="submit">Delete</button>
                                    </td>
                                </tr>
                            ';
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
    
    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <form action="add_contact.php" method="post">
                    <div class="field">
                        <label class="label">First Name</label>
                        <div class="control">
                            <input name="first_name" class="input" type="text" placeholder="e.g Alex" required="required">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Last Name</label>
                        <div class="control">
                            <input name="last_name" class="input" type="text" placeholder="e.g Smith">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Phone</label>
                        <div class="control">
                            <input name="phone" class="input" type="text" placeholder="e.g. 0744XXXXXX">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input name="email" class="input" type="email" placeholder="e.g. alexsmith@gmail.com">
                        </div>
                    </div>

                    <div class="control has-text-right">
                        <button name="submit" class="button is-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <button class="modal-close is-large" aria-label="close" onclick="toggleModal()"></button>
    </div>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
</body>
</html>