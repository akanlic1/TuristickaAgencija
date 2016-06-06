

<?php
session_start();

function zag ()
{
    header ( " {$_SERVER [ 'SERVER_PROTOCOL' ] } 200 OK" );
    header ( 'ContentType: text/html' );
    header ( 'AccessControlAllowOrigin:*' );
}

function rest_get ($request, $data)
{
    $dsn = 'mysql:dbname=wtbaza;host=127.0.0.1';
    $user = 'root';
    $password = '';

    try{
        $konekcija = new PDO($dsn, $user, $password);
     } catch (PDOException $e) {
          echo 'Konekcija nije uspjela: ' . $e->getMessage();
        }

    $konekcija->exec("set names utf8");
    $autor = $data['autor'];
    $limit = $data['x'];
    //$query = $konekcija->query("select * from novosti where autor_id=1 limit 5");
    $query = $konekcija->prepare("select * from novosti where autor_id=? limit ?");
    $query->bindValue(1, $autor, PDO::PARAM_INT);
    $query->bindValue(2, (int) $limit, PDO::PARAM_INT);
    $query->execute();
    $row_count = $query->rowCount();
    if($row_count == 0) print $data['x'];
    $resultJSON = json_encode($query->fetchAll(PDO::FETCH_ASSOC));
    print $resultJSON;

}

function rest_post ($request, $data){}

function rest_delete ($request){}

function rest_put ($request, $data){}

function rest_error ($request)
{
    print "Greška! Servis nije dostupan!";
}

$method = $_SERVER ['REQUEST_METHOD'];
$request = $_SERVER ['REQUEST_URI'];

switch ($method)
{
    case 'PUT':
        parse_str ( file_get_contents ( 'php://input' ), $put_vars );
        zag ();
        $data = $put_vars;
        rest_put ($request, $data);
        break;
    case 'POST':
        zag ();
        $data = $_POST;
        rest_post ($request, $data);
        break;
    case 'GET':
        zag ();
        $data = $_GET;
        rest_get ($request, $data);
        break;
    case 'DELETE':
        zag ();
        rest_delete ($request);
        break;
    default:
        header("{$_SERVER [ 'SERVER_PROTOCOL' ] } 404 Not Found" );
        rest_error ( $request );
        break;
}
?>