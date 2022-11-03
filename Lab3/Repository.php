<?php
class Repository
{
    public function saveAuction($array)
    {
        $file = fopen("auction.txt", "w");
        fwrite($file, serialize($array));
        fclose($file);
    }

    public function loadAuction()
    {
        $this->auctions = unserialize(file_get_contents("auction.txt"));
    }
}