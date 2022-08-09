<?php
include './inc/header.php';

$organizationId = $_SESSION['organizationId'];


$query = array(
    'key' => $key,
    'token' => $token,
);
$url = "https://api.trello.com/1/organizations/$organizationId/boards?" . http_build_query($query);
$curl = curl_init($url);
$headers = array(
    'Accept' => 'application/json',
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);

$boards = json_decode($response);

?>
<div class="card col-lg-4 mx-auto my-5 shadow">
    <div class="card-header bg-dark text-light">
        <h4>Add Board</h4>
    </div>
    <div class="card-body">
        <form action="../controller/addBoard.php" method="POST">
            <input type="text" name="boardName" class="form-control mb-3" placeholder="Board Name">

            <button class="btn btn-dark w-50 d-block m-auto mb-2" name="addBoard">Add New Board</button>
        </form>
    </div>
</div>

<div class="container mt-5">
    <h2 class="text-center mb-4">My Boards</h2>
    <div class="row">

        <?php
        foreach ($boards as $board) {
        ?>
            <div class="col-lg-3  py-3 shadow card mx-2">

                <div class="baord_cnt">
                    <h3 class="mb-3 text-dark"><?= $board->name ?></h3>
                    <div class="btn-group col-8">
                        <a href="./editBoard.php?id=<?= $board->id ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="./showBoard.php?id=<?= $board->id ?>&&board-name=<?= $board->name ?>" class="btn btn-sm btn-warning">View</a>
                        <a href="../controller/deleteBoard.php?id=<?= $board->id ?>" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                </div>

            </div>
        <?php
        }
        ?>




    </div>
</div>


<?php
include './inc/footer.php';
?>