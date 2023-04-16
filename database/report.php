<?php 
ini_set('display_errors', 0);
/** If the form has been submitted, prints the desired information. **/
if(isset($_POST['Report']) && isset($_POST['reportDataFrame']) && isset($_POST['selectedMonth'])){
    function LoadDataReport($reportType = "GetSales", $year = "", $month = ""){
        // Calls the database connection file
        require_once("Authenticate.php");
        // Calls the function that executes the query
        $sales = 0;
        $linesHTML = "";
        $DB = new Authenticate();
        $DB->type = $reportType;
        if($reportType == "GetSales") {
            $DB->param = array();
        } else {
            $DB->param = array($year, $month);
        }    
        $result = $DB->Fetch();
        if ($result) {
            // Cycle for defining variables with query results
            foreach($result as $line) {
                $linesHTML .= <<<HTML
                <tr>
                    <td>$line[IDSales]</td>
                    <td>$line[ClientID]</td>
                    <td>$line[VehicleID]</td>
                    <td>$line[ItemID]</td>
                    <td>$line[Total_price] €</td>
                    <td>$line[Sale_date]</td>
                    <td>$line[EmployeeID]</td>
                </tr>
HTML;
                $sales += (float)$line['Total_price'];
            }
            $namevalueextra = "Total Sales Value";
            $buttonHTML = <<<HTML
                <button onclick="location.href='database/download.php?queryType=GetSales&value_extra=$sales&name_value_extra=$namevalueextra&addValue=1'" 
                name="downloadfile" value="Export to Excel" class="btn btn-success" style="cursor: pointer; width:300px; float:right; margin-top:-40px">Export To Excel</button>
HTML;
            echo json_encode(array("sales"=>$sales . "€", "linesHTML"=>$linesHTML, "buttonHTML"=>$buttonHTML));
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }
    /** $view_data: Variable that defines the action to be taken, If "seeAll", shows the vehicle and Items sales data in total, 
    * If "currentMonth", shows vehicle and sales data for the selected/current month only. **/
    $view_data = $_POST['reportDataFrame'];
    switch($view_data){
        case 'seeAll':
            LoadDataReport();
            die();
        case 'currentMonth':
            // 
            $date = $_POST['selectedMonth'];
            $dateArray = explode("-", $date);
            $year = $dateArray[0];
            $month = $dateArray[1];
            LoadDataReport("GetSalesByMonth", $year, $month);
            die();    
        default:
            throw new Exception("Error Processing Request", 1);
            die();
    }
}
?>