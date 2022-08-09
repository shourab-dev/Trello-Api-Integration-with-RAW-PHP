<?php
include_once './inc/header.php';
$id = $_GET['id'];
$boardName = $_GET['board-name'];

$query = array(
    'key' => $key,
    'token' => $token
);
$url = "https://api.trello.com/1/boards/$id/lists?" . http_build_query($query);

$curl = curl_init($url);
$headers = array(
    'Accept' => 'application/json',
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
$lists = json_decode($response);


?>


<div class="container">
    <div class="row align-items-center justify-content-between">
        <div class="card col-lg-7 px-0 shadow mt-5  text-light ">
            <div class="card-header  bg-primary">
                <h4><?= $boardName ?></h4>
            </div>
            <div class="card-body text-dark">
                <div class="row justify-content-center">
                    <?php
                    foreach ($lists as $list) {
                    ?>
                        <div class="card shadow col-lg-3 py-4 my-2 mx-2 text-center">
                            <h6 class="mb-0"><a href="./showCards.php?list-id=<?= $list->id ?>" class="text-dark" style="text-decoration: none;"><?= $list->name ?></a></h6>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
        <aside class="col-lg-4 mt-5">
            <div class="card shadow px-0">
                <div class="card-header bg-dark text-light  ">
                    <h4>Add List</h4>
                </div>
                <div class="card-body">
                    <form action="../controller/storeList.php" method="POST">
                        <input type="hidden" name="boardId" value="<?= $id ?>">
                        <input type="hidden" name="boardName" value="<?= $boardName ?>">
                        <input type="text" name="listName" class="form-control mb-3" placeholder="List Name">
                        <button name="addList" type="submit" class="btn btn-dark w-100">Add List</button>
                    </form>
                </div>
            </div>
        </aside>
    </div>
</div>

<?php
include_once './inc/footer.php'

?>