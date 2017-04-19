<!DOCTYPE html>
<html>
<head>
    <style>
        .my-table {
            width: 100%;
            border-collapse: collapse;
        }

        .my-table, .my-td, .my-th {
            border: 1px solid black;
            padding: 5px;
            text-align: right;
        }

        .my-th {
            text-align: right;
        }
    </style>
</head>
<body>

<?php
//$q = intval($_GET['temp']);
//dd($number_of_adults);
$con = mysqli_connect('127.0.0.1', 'root', 'root', 'almthf');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con, "ajax_demo");
$sql = "SELECT * FROM rooms WHERE number_of_adults >= $number_of_adults and number_of_children >= $number_of_children;";
$result = mysqli_query($con, $sql);

?>
<form method="post">
    {{ csrf_field() }}
    <table id="example" class="display my-table" cellspacing="0">
        <thead class="my-head">
        <tr class="my-head">
            <th class="my-th">حجز</th>
            <th class="my-th">الوصف</th>
            <th class="my-th">السعر في الليلة</th>
            <th class="my-th">رقم الغرفة</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th class="my-th">حجز</th>
            <th class="my-th">الوصف</th>
            <th class="my-th">السعر في الليلة</th>
            <th class="my-th">رقم الغرفة</th>
        </tr>
        </tfoot>
        <tbody>
        <?php while ($row = mysqli_fetch_array($result)) {
        $sql2 = "SELECT * FROM books WHERE room_id = " . $row['id'] . " and ((date(come_date) BETWEEN '" . date("Y-m-d", strtotime($come_date)) . "' and '" . date("Y-m-d", strtotime($leave_date)) . "') OR (date(leave_date) BETWEEN '" . date("Y-m-d", strtotime($come_date)) . "' and '" . date("Y-m-d", strtotime($leave_date)) . "'))";
        echo "<br><br><br>$sql2<br><br><br><br>";
        $result2 = mysqli_query($con, $sql2);
        if (mysqli_num_rows($result2) == 0) {

        ?>
        <tr>
            <td class="my-td">
                <div class="radio">
                    <label><input type="radio" name="room_id" value="{{$row['id']}}"></label>
                </div>
            </td>
            <td class="my-td">{{$row['description']}}</td>
            <td class="my-td">{{$row['price']}}</td>
            <td class="my-td">{{$row['id']}}</td>
        </tr>
        <?php }
        }?>
        </tbody>
        <?php mysqli_close($con);?>
    </table>
    <input type="hidden" name="user_id" value="{{$user_id}}">
    <input type="hidden" name="number_of_adults" value="{{$number_of_adults}}">
    <input type="hidden" name="number_of_children" value="{{$number_of_children}}">
    <input type="hidden" name="come_date" value="{{$come_date}}">
    <input type="hidden" name="leave_date" value="{{$leave_date}}">
    <button type="submit" id="button"
            formaction="{{route('voyager.books.store') }}"
            class="btn btn-success save">حجز
    </button>
</form>
</body>
</html>