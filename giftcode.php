<?php
ob_start();
include "./main.php";
ob_end_flush();
?>

<style>
    #itemTable {
        border-collapse: collapse;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
    }

    #itemTable th,
    #itemTable td {
        padding: 12px;
        text-align: left;
        border-right: 1px solid #ff9899;
    }

    #itemTable tbody tr {
        border-bottom: 1px solid #ff9899;
    }

    #itemTable tbody tr:last-child {
        border-bottom: none;
    }

    #itemTable th:last-child,
    #itemTable td:last-child {
        border-right: none;
    }

    #itemTable thead th {
        background-color: #ff9899;
        color: white;
    }

    #itemTable th {
        background-color: #ff9899;
        color: white;
    }

    @media only screen and (max-width: 600px) {
        .search-container input[type="text"] {
            width: 100%;
        }
    }

    .card1 {
        width: 100%;
        overflow: hidden;
    }

    .card-body1 {
        overflow-x: auto;
    }
</style>

<div class="card">
    <center>
        <p>
            <h2 style="color: #ff8400;">🍑️Danh sách GiftCode🍑️</h2>
        </p>
    </center>
    <hr>
    <div class="card1">
        <div class="card-body1">
<?php include('success.php'); ?>
<?php include('error.php'); ?>
            <?php
            $show_delete_column = false;
            if (isset($_SESSION['username'])) {
            $sql = "SELECT role FROM player WHERE username = '" . $_SESSION['username'] . "'";
            $query = mysqli_query($conn, $sql);
            $num_rows = mysqli_num_rows($query);

            if ($num_rows > 0) {
                $row = mysqli_fetch_array($query);
                if ($row['role'] == 2002) {
                    $show_delete_column = true;
                }
            }
        }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["code"])) {
                    $codeToDelete = $_POST["code"];
                    $deleteQuery = "DELETE FROM gift_codes WHERE code = '$codeToDelete'";
                    if (checkAdmin($conn, $_SESSION['username'])) {
                        if ($conn->query($deleteQuery) === TRUE) {
                            $_SESSION['success'] = "Đã xoá!";
                            header("Location: " . $_SERVER['REQUEST_URI']);
                            exit(0);
                        } else {
                            $_SESSION['error'] = "Lỗi khi xoá mã!";
                            header("Location: " . $_SERVER['REQUEST_URI']);
                            exit(0);
                        }
                    } else {
                        $_SESSION['error'] = "Bạn không là gì để có thể xoá luôn ýyyy";
                        header("Location: " . $_SERVER['REQUEST_URI']);
                        exit(0);
                    }
                }
            }

            $sql = "SELECT code FROM gift_code ORDER BY code";
            $result = $conn->query($sql);

            ?>

            <table id='itemTable'>
                <tr>
                    <th>Gift Code</th>
                    <!-- <th>Vật phẩm</th>
                    <th>Xu</th>
                    <th>Yên</th>
                    <th>Lượng</th> -->

                    <!-- Hiển thị cột "Action" chỉ khi người dùng có vai trò admin -->
                    <?php if ($show_delete_column): ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["code"] . "</td><td>";

                        // $items = json_decode($row["items"], true);

                        // foreach ($items as $item) {
                        //     $itemId = $item['id'];
                            // $expire = $item['expire'];

                            // $itemQuery = "SELECT name FROM item WHERE id = $itemId";
                            // $itemResult = $conn->query($itemQuery);

                            // if ($itemResult->num_rows > 0) {
                            //     $itemName = $itemResult->fetch_assoc()['name'];

                                // echo "$itemName, thời hạn: ";
                                // echo $expire == -1 ? "Vĩnh viễn" : "Có thời hạn";
                                // echo "<br>";
                            }
                        }

                        // echo "</td><td>" . number_format($row["xu"]) . "</td><td>" . number_format($row["yên"]) . "</td><td>" . number_format($row["lượng"]) . "</td>";

                        // Hiển thị nút "Xóa" chỉ khi người dùng có vai trò admin
                        if ($show_delete_column) {
                            echo "<td><form method='post' action=''>";
                            echo "<input type='hidden' name='code' value='" . $row['code'] . "'>";
                            echo "<input type='submit' value='Xóa'></form></td>";

                        // }

                        // echo "</tr>";
            // } else {
            //         echo "<tr><td colspan='6'>Không có dữ liệu</td></tr>";
                }
                ?>

            </table>

        </div>
    </div>
</div>

<?php
include 'end.php';
?>
