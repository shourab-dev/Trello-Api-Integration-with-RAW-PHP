<?php
include_once './inc/header.php';
$listId = $_GET['list-id'];
$query = array(
    'key' => $key,
    'token' => $token
);
$url = "https://api.trello.com/1/lists/$listId/cards?" . http_build_query($query);

$curl = curl_init($url);
$headers = array(
    'Accept' => 'application/json',
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
$cards = json_decode($response);
// echo "<pre>";
// print_r($cards[1]->labels);


?>


<div class="container">
    <div class="row align-items-center justify-content-between">
        <div class="card col-lg-7 px-0 shadow mt-5  text-light ">
            <div class="card-header  bg-primary">
                <h4>All Cards</h4>
            </div>
            <div class="card-body text-dark px-2">
                <?php
                foreach ($cards as $card) {
                ?>
                    <div class="card shadow  py-4 my-2 mx-2 text-center" style="background:<?= count($card->labels)  > 0 ? $card->labels[0]->color . ';color:white;' : '' ?>">
                        <h6 class="mb-0"><?= $card->name ?></h6>
                        <p><?= $card->desc ?></p>
                    </div>
                <?php
                }
                ?>



            </div>
        </div>
        <aside class="col-lg-4 mt-5">
            <div class="card shadow px-0">
                <div class="card-header bg-dark text-light  ">
                    <h4>Add Card</h4>
                </div>
                <div class="card-body">
                    <form action="../controller/addCard.php" method="POST">
                        <input type="hidden" name="listId" value="<?= $listId ?>">
                        <input type="text" name="cardName" class="form-control mb-3" placeholder="Card Name">
                        <textarea name="cardDesc" id="" cols="30" rows="5" placeholder="Card Detail" class="form-control mb-3"></textarea>
                        <button name="addCard" type="submit" class="btn btn-dark w-100">Add Card</button>
                    </form>
                </div>
            </div>
        </aside>
    </div>
</div>

<?php
include_once './inc/footer.php'

?>