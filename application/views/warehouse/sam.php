<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your table2excel plugin -->
<script src="<?=$base_url?>/js/jquery.table2excel.js"></script>

<table id="headerTable">
    <thead>
        <tr>
            <th>Product</th>
            <th>Date End</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>D-nee Organic</td>
            <td>20/06/2028</td>
        </tr>
        <tr>
            <td>ແປ້ງເບບີ້</td>
            <td>18/08/2028</td>
        </tr>
    </tbody>
</table>

<button id="btnExport" class="btn btn-default">
    <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
    ດາວໂຫຼດ Excel
</button>

<script>
$(document).ready(function() {
    $("#btnExport").click(function() {
        // Trigger the plugin on the table
        $("#headerTable").c2mpos({
            filename: "ຕາຕະລາງ_Excel.xls"
        });
    });
});
</script>