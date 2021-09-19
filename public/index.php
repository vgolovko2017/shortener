<?php
    include "../config.php";
    include "database.php";

    uri_process();
    exit(1);

    function uri_process()
    {
        $r_uri = $_SERVER['REQUEST_URI'];
        $r_uri = clean_id($r_uri);

        if ($r_uri == 'addurl')
        {
            add_url($_POST['url']);
        }
        else if ($r_uri == 'geturls')
        {
            get_urls();
        }
        else if ($r_uri == 'delbyid')
        {
            del_by_id($_POST['id']);
        }
        else if (check_id($r_uri) == true) {
            redirectTo($r_uri);
        }
        else {
            header("Location: /");
        }
    }

    function check_id($id)
    {
        return preg_match("/^[A-Za-z]{5}$/", $id);
    }

    function clean_id($id)
    {
        // remove all non character symbols from short_id identifier
        return preg_replace("/[^A-Za-z]/", '', $id);
    }

    function del_by_id($id)
    {
        $dbh = get_db_instance();

        $id = clean_id($id);
        if (check_id($id) != true) {
            return false;
        }

        $query = "delete from short_urls where short_url_id = " . $dbh->quote($id) . " limit 1";
        try {
            $stmt = $dbh->prepare($query);
            $stmt->execute();
        } catch (PDOException $e) {
            logIt("Error: " . $e->getMessage());
            return false;
        }

        return $data;
    }

    function redirectTo($r_uri) {
        $data = _get_urls();

        if (!$data) {
            return false;
        }

        foreach ($data as $item) {
            if ($item['short_url_id'] == $r_uri) {
                header('Location: ' . $item['original_url']);
                return true;
            }
        }

         header("Location: /");
    }

    function get_urls()
    {
        $data = _get_urls();

        if ($data !== false) {
            echo json_encode($data);
        } else {
            if (array_key_exists('ErrorCode', $data) == true) {
                echo json_encode($data);
            }

            return false;
        }
    }

    function _get_urls()
    {
        $dbh = get_db_instance();

        $query = "select original_url, short_url_id from short_urls order by ts desc";
        try {
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            logIt("Error: " . $e->getMessage());
            return false;
        }

        return $data;
    }

    function add_url($url)
    {
        if ($url === false || strlen($url) == 0){
            logIt("Error: unknown param(s) in add_url()");
            return false;
        }

        if (preg_match('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i', $url) != true) {
            logIt('Error: URL is invalid: ' + $url);
            return false;
        }

        $data = _get_urls();
        logIt($url);
        foreach ($data as $item) {
            logIt($item['original_url']);
            if ($item['original_url'] == $url) {
                // URL already in database
                echo json_encode(['ErrorCode' => '10']);
                return false;
            }
        }

        $dbh = get_db_instance();
        $random = random_str();

        $query = "insert into short_urls set original_url = " . $dbh->quote($url) . ", short_url_id = '$random'";
        try {
            $stmt = $dbh->prepare($query);
            $stmt->execute();
        } catch (PDOException $e) {
            logIt("Error: " . $e->getMessage());
            return false;
        }

        echo json_encode(['Success' => '1']);
        return true;
    }

    function get_db_instance()
    {
        $db = Database::getInstance();
        $dbh = $db->getConnection();

        if (!$dbh) {
            logIt("Error: could not connect to db");
            return false;
        }

        return $dbh;
    }

    function logIt($msg = false)
    {
        if ($msg == false || $msg == "") {
            return false;
        }

        $date = date("Y/m/d H:i:s");
        file_put_contents(PATH_TO_LOG_FILE, "$date: $msg\n", FILE_APPEND | LOCK_EX);

        return true;
    }

    function random_str($length = 5)
    {
        return substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            ceil($length / strlen($x)))), 1, $length);
    }